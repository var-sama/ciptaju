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

        $statusOptions = [
            StudentRegistration::STATUS_PENDING => 'Pending',
            StudentRegistration::STATUS_ACCEPTED => 'Diterima',
            StudentRegistration::STATUS_REJECTED => 'Ditolak',
        ];
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(array_keys($statusOptions))],
        ]);
        $search = trim($filters['search'] ?? '');
        $status = $filters['status'] ?? null;

        $statistics = StudentRegistration::query()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN status = ? THEN 1 ELSE 0 END), 0) as pending',
                [StudentRegistration::STATUS_PENDING],
            )
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN status = ? THEN 1 ELSE 0 END), 0) as accepted',
                [StudentRegistration::STATUS_ACCEPTED],
            )
            ->selectRaw(
                'COALESCE(SUM(CASE WHEN status = ? THEN 1 ELSE 0 END), 0) as rejected',
                [StudentRegistration::STATUS_REJECTED],
            )
            ->firstOrFail();

        $registrationsQuery = StudentRegistration::query();

        if ($search !== '') {
            $registrationsQuery->where('student_name', 'like', '%'.$search.'%');
        }

        if ($status !== null) {
            $registrationsQuery->where('status', $status);
        }

        return view('admins.registrations.index', [
            'registrations' => $registrationsQuery->latest()->paginate(15)->withQueryString(),
            'search' => $search,
            'status' => $status,
            'statusOptions' => $statusOptions,
            'statistics' => $statistics,
        ]);
    }

    public function show(Request $request, StudentRegistration $studentRegistration): View
    {
        $this->authorizeAdmin($request);

        return view('admins.registrations.show', [
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
            ->route('admins.registrations.show', $studentRegistration)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->role === 'admin', 403);
    }
}
