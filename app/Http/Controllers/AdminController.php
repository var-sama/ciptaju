<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    private const ROLES = ['admin', 'teacher', 'student', 'user'];

    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);

        $users = User::query()->latest()->get();

        return view('admins.index', [
            'users' => $users,
            'adminCount' => $users->where('role', 'admin')->count(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(self::ROLES)],
        ]);

        User::create($validated);

        return response()->json(['message' => 'Pengguna berhasil ditambahkan.'], 201);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(self::ROLES)],
        ]);

        if ($user->role === 'admin' && $validated['role'] !== 'admin' && User::query()->where('role', 'admin')->count() === 1) {
            return response()->json([
                'message' => 'Pengguna ini adalah admin terakhir dan tidak dapat diubah menjadi pengguna biasa.',
            ], 422);
        }

        $user->fill(Arr::only($validated, ['name', 'email', 'role']));

        if (filled($validated['password'] ?? null)) {
            $user->password = $validated['password'];
        }

        $user->save();

        return response()->json(['message' => 'Pengguna berhasil diperbarui.']);
    }

    public function destroy(Request $request, User $user): JsonResponse
    {
        $this->authorizeAdmin($request);

        if ($user->role === 'admin' && User::query()->where('role', 'admin')->count() === 1) {
            return response()->json([
                'message' => 'Admin terakhir tidak dapat dihapus.',
            ], 422);
        }

        if ($request->user()?->is($user)) {
            return response()->json([
                'message' => 'Akun yang sedang digunakan tidak dapat dihapus.',
            ], 422);
        }

        $user->delete();

        return response()->json(['message' => 'Pengguna berhasil dihapus.']);
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}
