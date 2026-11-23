const userTableBody = document.getElementById('user-table-body');
const userSearch = document.getElementById('user-search');
const userRoleFilter = document.getElementById('user-role-filter');
const userDialog = document.getElementById('user-dialog');
const userForm = document.getElementById('user-form');

if (userTableBody && userSearch && userRoleFilter && userDialog && userForm) {
    const userRows = [...userTableBody.querySelectorAll('[data-user-row]')];
    let activeUserRow = null;

    const renderUsers = () => {
        const searchTerm = userSearch.value.trim().toLocaleLowerCase('id-ID');
        const selectedRole = userRoleFilter.value;
        let visibleCount = 0;

        userRows.forEach((row) => {
            const matchesSearch = `${row.dataset.name} ${row.dataset.email}`
                .toLocaleLowerCase('id-ID')
                .includes(searchTerm);
            const matchesRole = selectedRole === '' || row.dataset.role === selectedRole;
            const isVisible = matchesSearch && matchesRole;

            row.classList.toggle('hidden', !isVisible);
            visibleCount += Number(isVisible);
        });

        document.getElementById('user-empty-state').classList.toggle('hidden', visibleCount > 0);
        document.getElementById('user-count').textContent = `Menampilkan ${visibleCount} dari ${userRows.length} pengguna`;
    };

    const setFormMode = (mode, row = null) => {
        activeUserRow = row;
        userForm.reset();
        userForm.elements.namedItem('id').value = row?.dataset.userId ?? '';
        userForm.elements.namedItem('name').value = row?.dataset.name ?? '';
        userForm.elements.namedItem('email').value = row?.dataset.email ?? '';
        userForm.elements.namedItem('role').value = row?.dataset.role ?? 'student';
        userForm.elements.namedItem('password').required = mode === 'create';

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

    const showFormError = (message) => {
        const error = document.getElementById('user-form-error');
        error.textContent = message;
        error.classList.remove('hidden');
    };

    const readErrorMessage = (payload) => {
        const validationError = Object.values(payload.errors ?? {}).flat()[0];

        return validationError ?? payload.message ?? 'Permintaan gagal. Silakan coba lagi.';
    };

    const sendRequest = async (url, body) => {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body,
        });
        const payload = await response.json();

        if (!response.ok) {
            throw new Error(readErrorMessage(payload));
        }

        return payload;
    };

    document.getElementById('user-create').addEventListener('click', () => setFormMode('create'));
    document.getElementById('user-dialog-close').addEventListener('click', closeDialog);
    document.getElementById('user-dialog-cancel').addEventListener('click', closeDialog);
    userSearch.addEventListener('input', renderUsers);
    userRoleFilter.addEventListener('change', renderUsers);

    userTableBody.addEventListener('click', async (event) => {
        const target = event.target;
        if (!(target instanceof Element)) {
            return;
        }

        const actionButton = target.closest('[data-user-view], [data-user-edit], [data-user-delete]');
        if (!actionButton) {
            return;
        }

        const row = actionButton.closest('[data-user-row]');
        if (!row) {
            return;
        }

        if (actionButton.hasAttribute('data-user-view')) {
            setFormMode('view', row);
            return;
        }

        if (actionButton.hasAttribute('data-user-edit')) {
            setFormMode('edit', row);
            return;
        }

        if (!window.confirm(`Hapus pengguna "${row.dataset.name}"?`)) {
            return;
        }

        const body = new FormData();
        body.append('_token', userForm.elements.namedItem('_token').value);
        body.append('_method', 'DELETE');

        try {
            await sendRequest(actionButton.closest('[data-user-row]').dataset.deleteUrl, body);
            window.location.reload();
        } catch (error) {
            window.alert(error.message);
        }
    });

    userForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        document.getElementById('user-form-error').classList.add('hidden');

        const body = new FormData(userForm);
        const userId = body.get('id');
        const url = userId ? activeUserRow?.dataset.updateUrl : userForm.dataset.storeUrl;
        body.delete('id');

        if (userId) {
            body.append('_method', 'PUT');
        }

        try {
            await sendRequest(url, body);
            window.location.reload();
        } catch (error) {
            showFormError(error.message);
        }
    });

    userDialog.addEventListener('click', (event) => {
        if (event.target === userDialog) {
            closeDialog();
        }
    });

    renderUsers();
}
