// Admin Dashboard JavaScript
// Configure axios
const csrfMeta = document.querySelector('meta[name="csrf-token"]');
if (csrfMeta) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');
}
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

async function viewUser(id) {
    try {
        const res = await axios.get(`/admin/users/${id}`);
        const payload = res && res.data ? res.data : res;
        openUserModal(payload, 'view');
    } catch (err) {
        alert('Chyba pri načítaní používateľa');
        console.error(err);
    }
}

function openUserModal(user, mode = 'edit') {
    user = user || {};
    document.getElementById('userId').value = user.id || '';
    document.getElementById('userName').value = user.name || '';
    document.getElementById('userSurname').value = user.surname || '';
    document.getElementById('userEmail').value = user.email || '';
    document.getElementById('userPhone').value = user.phone || '';

    const roleSelect = document.getElementById('userRole');
    if (roleSelect) {
        roleSelect.value = user.role || 'patient';
        roleSelect.setAttribute('disabled', 'disabled');
    }

    const saveBtn = document.getElementById('saveUserBtn');
    if (mode === 'view') {
        document.getElementById('modalTitle').innerText = 'Zobraziť používateľa';
        ['userName','userSurname','userEmail','userPhone'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.setAttribute('disabled','disabled');
        });
        if (saveBtn) saveBtn.style.display = 'none';
    } else {
        document.getElementById('modalTitle').innerText = 'Upraviť používateľa';
        ['userName','userSurname','userEmail','userPhone'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.removeAttribute('disabled');
        });
        if (saveBtn) saveBtn.style.display = 'inline-block';
    }
    document.getElementById('userModal').style.display = 'flex';
}

function closeUserModal() {
    const modal = document.getElementById('userModal');
    if (modal) modal.style.display = 'none';
}

async function saveUser() {
    const id = document.getElementById('userId').value;
    const payload = {
        name: document.getElementById('userName').value,
        surname: document.getElementById('userSurname').value,
        email: document.getElementById('userEmail').value,
        phone: document.getElementById('userPhone').value,
    };

    try {
        const res = await axios.put(`/admin/users/${id}`, payload);
        alert('Uložené');
        closeUserModal();
        window.location.reload();
    } catch (err) {
        alert('Chyba pri uložení: ' + (err.response?.data?.message || err.message));
        console.error(err);
    }
}

async function deleteUser(id) {
    if (!confirm('Naozaj chcete používateľa vymazať?')) return;
    try {
        await axios.delete(`/admin/users/${id}`);
        alert('Používateľ vymazaný');
        window.location.reload();
    } catch (err) {
        alert('Chyba pri mazaní: ' + (err.response?.data?.message || err.message));
        console.error(err);
    }
}

function handleLogout() {
    const token = localStorage.getItem('userToken');

    if (!token) {
        window.location.href = '/prihlasenie';
        return;
    }

    axios.post('/api/logout', {}, {
        headers: { 'Authorization': `Bearer ${token}` }
    }).finally(() => {
        localStorage.removeItem('userToken');
        localStorage.removeItem('user');
        window.location.href = '/prihlasenie';
    });
}

// Modal background click
document.addEventListener('DOMContentLoaded', function() {
    const userModal = document.getElementById('userModal');
    if (userModal) {
        userModal.addEventListener('click', function(e) {
            if (e.target === this) closeUserModal();
        });
    }
});

