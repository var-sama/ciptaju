<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentRegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorizeAdmin($request);

        return view('admin.student-registrations.index', [
            'registrations' => StudentRegistration::query()->latest()->paginate(15),
        ]);
    }

    public function show(Request $request, StudentRegistration $studentRegistration): View
    {
        $this->authorizeAdmin($request);

        return view('admin.student-registrations.show', [
            'registration' => $studentRegistration,
        ]);
    }

    public function updateStatus(Request $request, StudentRegistration $studentRegistration): RedirectResponse
    {
        $this->authorizeAdmin($request);

        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in([
                    StudentRegistration::STATUS_PENDING,
                    StudentRegistration::STATUS_ACCEPTED,
                    StudentRegistration::STATUS_REJECTED,
                ]),
            ],
        ]);

        $studentRegistration->update($validated);

        return redirect()
            ->route('admin.registrations.show', $studentRegistration)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}
