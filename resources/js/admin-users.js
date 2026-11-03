const userTableBody = document.getElementById('user-table-body');
const userSearch = document.getElementById('user-search');
const userRoleFilter = document.getElementById('user-role-filter');
const userDialog = document.getElementById('user-dialog');
const userForm = document.getElementById('user-form');

if (userTableBody && userSearch && userRoleFilter && userDialog && userForm) {
    let users = [
        { id: 1, name: 'Alya Putri', email: 'alya.putri@ciptaju.sch.id', role: 'Admin', joinedAt: '2026-09-18' },
        { id: 2, name: 'Rina Lestari', email: 'rina.lestari@ciptaju.sch.id', role: 'Guru', joinedAt: '2026-09-20' },
        { id: 3, name: 'Bima Pratama', email: 'bima.pratama@ciptaju.sch.id', role: 'Siswa', joinedAt: '2026-09-22' },
        { id: 4, name: 'Citra Maharani', email: 'citra.maharani@ciptaju.sch.id', role: 'Siswa', joinedAt: '2026-10-02' },
        { id: 5, name: 'Dimas Saputra', email: 'dimas.saputra@ciptaju.sch.id', role: 'Pengguna', joinedAt: '2026-10-09' },
    ];
    let nextUserId = Math.max(...users.map((user) => user.id)) + 1;

    const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (character) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;',
    })[character]);

    const getInitials = (name) => name
        .trim()
        .split(/\s+/)
        .slice(0, 2)
        .map((part) => part.charAt(0).toUpperCase())
        .join('');

    const formatDate = (date) => new Intl.DateTimeFormat('id-ID', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    }).format(new Date(`${date}T00:00:00`));

    const updateStats = () => {
        document.getElementById('stat-total').textContent = users.length;
        document.getElementById('stat-admin').textContent = users.filter((user) => user.role === 'Admin').length;
    };

    const renderUsers = () => {
        const searchTerm = userSearch.value.trim().toLocaleLowerCase('id-ID');
        const selectedRole = userRoleFilter.value;
        const visibleUsers = users.filter((user) => {
            const matchesSearch = `${user.name} ${user.email}`.toLocaleLowerCase('id-ID').includes(searchTerm);
            const matchesRole = selectedRole === '' || user.role === selectedRole;
            return matchesSearch && matchesRole;
        });

        userTableBody.innerHTML = visibleUsers.map((user) => {
            const roleClasses = {
                Admin: 'bg-violet-50 text-violet-700',
                Guru: 'bg-emerald-50 text-emerald-700',
                Siswa: 'bg-[#10A4B0]/10 text-[#087b84]',
                Pengguna: 'bg-slate-100 text-slate-700',
            }[user.role];

            return `
                <tr class="transition-colors hover:bg-[#F7F6F2]/70">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#003135] text-xs font-bold text-white">${escapeHtml(getInitials(user.name))}</span>
                            <span class="min-w-0">
                                <span class="block truncate font-bold text-[#003135]">${escapeHtml(user.name)}</span>
                                <span class="mt-0.5 block truncate text-xs text-slate-500">${escapeHtml(user.email)}</span>
                            </span>
                        </div>
                    </td>
                    <td class="px-5 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-bold ${roleClasses}">${escapeHtml(user.role)}</span></td>
                    <td class="px-5 py-4 text-slate-600">${escapeHtml(formatDate(user.joinedAt))}</td>
                    <td class="px-5 py-4">
                        <div class="flex justify-end gap-1">
                            <button type="button" data-user-view="${user.id}" class="rounded-md px-2.5 py-2 font-semibold text-[#003135] transition hover:bg-[#10A4B0]/10 hover:text-[#087b84] focus-visible:outline-2 focus-visible:outline-[#10A4B0]" aria-label="Lihat ${escapeHtml(user.name)}" title="Lihat detail">Lihat</button>
                            <button type="button" data-user-edit="${user.id}" class="rounded-md px-2.5 py-2 font-semibold text-[#087b84] transition hover:bg-[#10A4B0]/10 focus-visible:outline-2 focus-visible:outline-[#10A4B0]" aria-label="Edit ${escapeHtml(user.name)}" title="Edit pengguna">Edit</button>
                            <button type="button" data-user-delete="${user.id}" class="rounded-md px-2.5 py-2 font-semibold text-red-700 transition hover:bg-red-50 focus-visible:outline-2 focus-visible:outline-red-600" aria-label="Hapus ${escapeHtml(user.name)}" title="Hapus pengguna">Hapus</button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');

        document.getElementById('user-empty-state').classList.toggle('hidden', visibleUsers.length > 0);
        document.getElementById('user-count').textContent = `Menampilkan ${visibleUsers.length} dari ${users.length} pengguna`;
        updateStats();
    };

    const setFormMode = (mode, user = null) => {
        userForm.reset();
        userForm.elements.namedItem('id').value = user?.id ?? '';
        userForm.elements.namedItem('name').value = user?.name ?? '';
        userForm.elements.namedItem('email').value = user?.email ?? '';
        userForm.elements.namedItem('role').value = user?.role ?? 'Siswa';

        const isViewMode = mode === 'view';
        userForm.querySelectorAll('input:not([type="hidden"]), select').forEach((field) => {
            field.disabled = isViewMode;
        });
        document.getElementById('user-dialog-title').textContent = {
            create: 'Tambah pengguna',
            edit: 'Edit pengguna',
            view: 'Detail pengguna',
        }[mode];
        document.getElementById('user-dialog-description').textContent = isViewMode
            ? 'Informasi akun pengguna.'
            : 'Isi informasi akun pengguna.';
        document.getElementById('user-save').classList.toggle('hidden', isViewMode);
        document.getElementById('user-dialog-cancel').textContent = isViewMode ? 'Tutup' : 'Batal';
        document.getElementById('user-form-error').classList.add('hidden');
        userDialog.showModal();
    };

    const closeDialog = () => {
        userDialog.close();
        userForm.querySelectorAll('input:not([type="hidden"]), select').forEach((field) => {
            field.disabled = false;
        });
    };

    document.getElementById('user-create').addEventListener('click', () => setFormMode('create'));
    document.getElementById('user-dialog-close').addEventListener('click', closeDialog);
    document.getElementById('user-dialog-cancel').addEventListener('click', closeDialog);
    userSearch.addEventListener('input', renderUsers);
    userRoleFilter.addEventListener('change', renderUsers);

    userTableBody.addEventListener('click', (event) => {
        const target = event.target;
        if (!(target instanceof Element)) {
            return;
        }

        const viewButton = target.closest('[data-user-view]');
        const editButton = target.closest('[data-user-edit]');
        const deleteButton = target.closest('[data-user-delete]');
        const actionButton = viewButton ?? editButton ?? deleteButton;
        if (!actionButton) {
            return;
        }

        const userId = Number(actionButton.dataset.userView ?? actionButton.dataset.userEdit ?? actionButton.dataset.userDelete);
        const user = users.find((item) => item.id === userId);
        if (!user) {
            return;
        }

        if (viewButton) {
            setFormMode('view', user);
            return;
        }

        if (editButton) {
            setFormMode('edit', user);
            return;
        }

        if (window.confirm(`Hapus pengguna "${user.name}" dari daftar preview?`)) {
            users = users.filter((item) => item.id !== userId);
            renderUsers();
        }
    });

    userForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(userForm);
        const userId = formData.get('id');
        const name = String(formData.get('name')).trim();
        const email = String(formData.get('email')).trim();
        const duplicateEmail = users.some((user) => user.email.toLocaleLowerCase('id-ID') === email.toLocaleLowerCase('id-ID') && String(user.id) !== userId);
        if (duplicateEmail) {
            const error = document.getElementById('user-form-error');
            error.textContent = 'Email tersebut sudah digunakan oleh pengguna lain.';
            error.classList.remove('hidden');
            return;
        }

        if (userId) {
            users = users.map((user) => user.id === Number(userId)
                ? { ...user, name, email, role: formData.get('role') }
                : user);
        } else {
            users.unshift({
                id: nextUserId++,
                name,
                email,
                role: formData.get('role'),
                joinedAt: new Date().toISOString().slice(0, 10),
            });
        }

        renderUsers();
        closeDialog();
    });

    userDialog.addEventListener('click', (event) => {
        if (event.target === userDialog) {
            closeDialog();
        }
    });

    renderUsers();
}
