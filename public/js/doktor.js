// Doktor Dashboard JavaScript
const API_URL = window.location.origin + '/api';

if (typeof axios !== 'undefined') {
    axios.defaults.baseURL = API_URL;
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['Accept'] = 'application/json';
    axios.defaults.withCredentials = true;
}

// Modal helpers
function showImageModal(url) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('imageModalImg');
    const err = document.getElementById('imageModalError');
    if (!modal || !img || !err) return;
    if (!url) {
        img.style.display = 'none';
        err.style.display = 'block';
        modal.style.display = 'flex';
        return;
    }
    img.src = url;
    img.style.display = 'block';
    err.style.display = 'none';
    modal.style.display = 'flex';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('imageModalImg');
    const err = document.getElementById('imageModalError');
    if (!modal || !img || !err) return;
    modal.style.display = 'none';
    img.src = '';
    err.style.display = 'none';
}

document.addEventListener('click', function (ev) {
    if (ev.target && ev.target.id === 'imageModalClose') {
        closeImageModal();
    }
    if (ev.target && ev.target.id === 'imageModal') {
        closeImageModal();
    }
});

// Logout
document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.onclick = async function() {
            try {
                const token = localStorage.getItem('userToken');
                const headers = token ? { 'Authorization': `Bearer ${token}` } : {};
                await axios.post('/logout', {}, { headers });
            } catch (e) {
                console.warn('Logout failed', e);
            } finally {
                localStorage.removeItem('userToken');
                localStorage.removeItem('user');
                window.location.href = '/prihlasenie';
            }
        };
    }
});

// Load doctor data
async function loadDoctorData() {
    let doctor = null;
    try {
        const token = localStorage.getItem('userToken');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        } else {
            delete axios.defaults.headers.common['Authorization'];
        }

        const resp = await axios.get('/user');
        const respData = resp && resp.data ? resp.data : null;
        doctor = respData && respData.user ? respData.user : respData;

        if (!doctor || typeof doctor !== 'object') {
            throw new Error('No user data');
        }

        const displayName = (doctor.name || doctor.email || 'Doktor');
        const welcomeEl = document.getElementById('welcomeName');
        if (welcomeEl) welcomeEl.innerText = displayName;

    } catch (err) {
        console.warn('Could not load user:', err);
        const welcomeEl = document.getElementById('welcomeName');
        if (welcomeEl) welcomeEl.innerText = 'Doktor';
        document.getElementById('examTableBody').innerHTML = '<tr><td colspan="4" class="no-exams">Chyba: nie ste prihlásený.</td></tr>';
        return;
    }

    // Load exams
    try {
        const examsResp = await axios.get(`/doctors/${doctor.id}/examinations`);
        const exams = examsResp && examsResp.data ? examsResp.data : [];

        // Stats
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        let examsTodayCount = 0;
        let examsTotalCount = exams.length;

        exams.forEach(e => {
            if (e.created_at) {
                const examDate = new Date(e.created_at.replace(' ', 'T'));
                const examDateOnly = new Date(examDate.getFullYear(), examDate.getMonth(), examDate.getDate());
                if (examDateOnly.getTime() === today.getTime()) {
                    examsTodayCount++;
                }
            }
        });

        const todayEl = document.getElementById('examsTodayCount');
        const totalEl = document.getElementById('examsTotalCount');
        if (todayEl) todayEl.innerText = examsTodayCount;
        if (totalEl) totalEl.innerText = examsTotalCount;

        if (!exams || exams.length === 0) {
            document.getElementById('examTableBody').innerHTML = '<tr><td colspan="4" class="no-exams">Žiadne vyšetrenia.</td></tr>';
            return;
        }

        document.getElementById('examTableBody').innerHTML = exams.map(e => {
            const date = e.created_at ? new Date(e.created_at.replace(' ', 'T')).toLocaleDateString('sk-SK') : '';
            const patientName = e.patient ? (e.patient.name || 'Pacient') : 'Neznámy';

            let statusClass = '';
            let statusText = e.result ? e.result : 'N/A';
            if (e.result === 'positive') statusClass = 'status-positive';
            else if (e.result === 'negative') statusClass = 'status-negative';
            else statusClass = 'status-unknown';

            const photoUrl = e.photo_url || '';

            return `
            <tr>
                <td class="exam-date">${date}</td>
                <td>${patientName}</td>
                <td><span class="exam-status ${statusClass}">${statusText}</span></td>
                <td>
                    <div class="exam-actions">
                        ${photoUrl ? `<button class="btn-view" data-photo="${photoUrl}">Zobraziť</button>` : ''}
                        <button class="btn-edit" data-exam-id="${e.id}">Upraviť</button>
                        <button class="btn-delete" data-exam-id="${e.id}">Zmazať</button>
                    </div>
                </td>
            </tr>
            `;
        }).join('');

        // View button handlers
        document.querySelectorAll('.btn-view').forEach(btn => {
            btn.onclick = function(ev) {
                ev.preventDefault();
                let url = this.getAttribute('data-photo') || '';
                if (!url) {
                    alert('Fotka nie je dostupná.');
                    return;
                }

                try {
                    if (url.startsWith('http://') || url.startsWith('https://')) {
                        const parsed = new URL(url);
                        if (parsed.origin !== window.location.origin) {
                            url = window.location.origin + parsed.pathname + (parsed.search || '');
                        } else {
                            url = parsed.href;
                        }
                    } else if (url.startsWith('/')) {
                        url = window.location.origin + url;
                    } else {
                        if (url.startsWith('storage/')) {
                            url = window.location.origin + '/' + url;
                        } else {
                            url = window.location.origin + '/storage/' + url.replace(/^\/+/, '');
                        }
                    }
                    showImageModal(url);
                } catch (err) {
                    console.error('Error preparing image URL', err);
                    alert('Chyba pri otváraní fotky.');
                }
            };
        });

        // Edit button handlers
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.onclick = function() {
                const examId = this.getAttribute('data-exam-id');
                openExamEditor(examId);
            };
        });

        // Delete button handlers
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.onclick = function() {
                const examId = this.getAttribute('data-exam-id');
                deleteExam(examId);
            };
        });

    } catch (err) {
        console.error('Error loading exams:', err);
        document.getElementById('examTableBody').innerHTML = '<tr><td colspan="4" class="no-exams">Chyba pri načítaní vyšetrení.</td></tr>';
    }
}

function openExamModalForPatientPrompt() {
    const modal = document.getElementById('addExamModal');
    if (!modal) return;

    document.getElementById('newExamPatientId').value = '';
    document.getElementById('patientNameDisplay').value = '';
    document.getElementById('newExamPhoto').value = '';
    document.getElementById('newExamResult').value = 'negative';
    document.getElementById('newExamNotes').value = '';
    document.getElementById('patientValidation').innerHTML = '';
    document.getElementById('saveExamBtn').disabled = true;

    modal.style.display = 'flex';
}

function closeAddExamModal() {
    const modal = document.getElementById('addExamModal');
    if (modal) modal.style.display = 'none';
}

// Patient validation
let patientCheckTimeout = null;
document.addEventListener('DOMContentLoaded', function() {
    const patientIdInput = document.getElementById('newExamPatientId');
    const patientNameDisplay = document.getElementById('patientNameDisplay');
    const patientValidation = document.getElementById('patientValidation');
    const saveBtn = document.getElementById('saveExamBtn');

    if (patientIdInput) {
        patientIdInput.addEventListener('input', function() {
            const patientId = this.value.trim();

            patientValidation.innerHTML = '';
            patientNameDisplay.value = '';
            saveBtn.disabled = true;

            if (patientCheckTimeout) clearTimeout(patientCheckTimeout);

            if (!patientId || patientId < 1) return;

            patientValidation.innerHTML = '<span style="color:#6b7280;">🔍 Overujem pacienta...</span>';

            patientCheckTimeout = setTimeout(async () => {
                try {
                    const token = localStorage.getItem('userToken');
                    const headers = token ? { 'Authorization': `Bearer ${token}` } : {};

                    const response = await axios.get(`/users/${patientId}`, { headers });
                    const user = response.data;

                    if (user && user.role === 'patient') {
                        patientValidation.innerHTML = '<span style="color:#065f46;">✓ Pacient existuje</span>';
                        patientNameDisplay.value = user.name + (user.surname ? ' ' + user.surname : '');
                        saveBtn.disabled = false;
                    } else if (user && user.role !== 'patient') {
                        patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Toto ID nepatrí pacientovi (rola: ' + user.role + ')</span>';
                        saveBtn.disabled = true;
                    } else {
                        patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Pacient nenájdený</span>';
                        saveBtn.disabled = true;
                    }
                } catch (error) {
                    if (error.response && error.response.status === 404) {
                        patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Pacient s týmto ID neexistuje</span>';
                    } else {
                        patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Chyba pri overovaní</span>';
                    }
                    saveBtn.disabled = true;
                }
            }, 500);
        });
    }

    if (saveBtn) {
        saveBtn.addEventListener('click', async function() {
            const patientId = document.getElementById('newExamPatientId').value;
            const photoInput = document.getElementById('newExamPhoto');
            const result = document.getElementById('newExamResult').value;
            const notes = document.getElementById('newExamNotes').value;

            if (!patientId || !photoInput.files[0]) {
                alert('Vyplňte všetky povinné polia');
                return;
            }

            const fd = new FormData();
            fd.append('patient_id', patientId);
            fd.append('photo', photoInput.files[0]);
            fd.append('result', result);
            if (notes) fd.append('notes', notes);

            try {
                this.disabled = true;
                this.innerText = 'Ukladám...';

                const token = localStorage.getItem('userToken');
                const headers = token ? { 'Authorization': `Bearer ${token}` } : {};
                await axios.post('/examinations', fd, { headers });

                alert('Vyšetrenie úspešne uložené');
                closeAddExamModal();
                loadDoctorData();
            } catch (err) {
                alert('Chyba: ' + (err.response?.data?.message || err.message));
                this.disabled = false;
                this.innerText = 'Uložiť vyšetrenie';
            }
        });
    }

    const addExamModal = document.getElementById('addExamModal');
    if (addExamModal) {
        addExamModal.addEventListener('click', function(e) {
            if (e.target === this) closeAddExamModal();
        });
    }
});

function openExamEditor(examId) {
    (async function() {
        try {
            const res = await axios.get(`/examinations/${examId}`);
            const exam = res.data;

            const createdDate = exam.created_at ? new Date(exam.created_at.replace(' ', 'T')).toISOString().split('T')[0] : new Date().toISOString().split('T')[0];
            const patientName = exam.patient ? (exam.patient.name || 'Pacient') : 'Neznámy';

            const modal = document.createElement('div');
            modal.className = 'modal-dialog active';
            modal.innerHTML = `
                <div class="modal-content-box">
                    <h3>Upraviť vyšetrenie #${exam.id}</h3>
                    <div class="form-group">
                        <label>ID Pacienta:</label>
                        <input type="text" value="${exam.patient_id}" disabled style="background:#f3f4f6;cursor:not-allowed;">
                    </div>
                    <div class="form-group">
                        <label>Pacient:</label>
                        <input type="text" value="${patientName}" disabled style="background:#f3f4f6;cursor:not-allowed;">
                    </div>
                    <div class="form-group">
                        <label>Dátum vyšetrenia:</label>
                        <input type="date" id="editDate" value="${createdDate}">
                    </div>
                    <div class="form-group">
                        <label>Nález:</label>
                        <select id="editResult">
                            <option value="positive" ${exam.result === 'positive' ? 'selected' : ''}>Pozitívny</option>
                            <option value="negative" ${exam.result === 'negative' ? 'selected' : ''}>Negatívny</option>
                        </select>
                    </div>
                    <div class="modal-actions">
                        <button class="btn-cancel" onclick="this.closest('.modal-dialog').remove()">Zrušiť</button>
                        <button class="btn-save" onclick="saveExamChanges(${exam.id})">Uložiť zmeny</button>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.remove();
            });

            window.currentExamEdit = { examId: exam.id, modal: modal };

        } catch (err) {
            alert('Chyba pri načítaní vyšetrenia');
        }
    })();
}

async function saveExamChanges(examId) {
    try {
        const dateInput = document.getElementById('editDate');
        const resultSelect = document.getElementById('editResult');

        const fd = new FormData();
        fd.append('_method', 'PUT');
        fd.append('result', resultSelect.value);
        if (dateInput.value) fd.append('created_at', dateInput.value + ' 00:00:00');

        const token = localStorage.getItem('userToken');
        const headers = token ? { 'Authorization': `Bearer ${token}` } : {};

        await axios.post(`/examinations/${examId}`, fd, { headers });

        alert('Vyšetrenie aktualizované');

        if (window.currentExamEdit && window.currentExamEdit.modal) {
            window.currentExamEdit.modal.remove();
        }

        loadDoctorData();
    } catch (err) {
        alert('Chyba: ' + (err.response?.data?.message || err.message));
    }
}

async function deleteExam(examId) {
    if (!confirm('Naozaj chcete zmazať toto vyšetrenie?')) return;

    try {
        const token = localStorage.getItem('userToken');
        const headers = token ? { 'Authorization': `Bearer ${token}` } : {};
        await axios.delete(`/examinations/${examId}`, { headers });
        alert('Vyšetrenie zmazané');
        loadDoctorData();
    } catch (err) {
        alert('Chyba: ' + (err.response?.data?.message || err.message));
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadDoctorData();
});

