// Pacient Dashboard JavaScript
const API_URL = window.location.origin + '/api';

if (typeof axios !== 'undefined') {
    axios.defaults.baseURL = API_URL;
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['Accept'] = 'application/json';
    axios.defaults.withCredentials = true;
}

// Image modal
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

document.addEventListener('click', function(ev) {
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

// Load patient data
async function loadPatientData() {
    let patient = null;
    try {
        const token = localStorage.getItem('userToken');
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        } else {
            delete axios.defaults.headers.common['Authorization'];
        }

        const resp = await axios.get('/user');
        const respData = resp && resp.data ? resp.data : null;
        patient = respData && respData.user ? respData.user : respData;

        if (!patient || typeof patient !== 'object') {
            throw new Error('No user data');
        }

        const displayName = (patient.name || patient.email || 'Pacient');
        const welcomeEl = document.getElementById('welcomeName');
        if (welcomeEl) welcomeEl.innerText = displayName;

    } catch (err) {
        console.warn('Could not load user:', err);
        const welcomeEl = document.getElementById('welcomeName');
        if (welcomeEl) welcomeEl.innerText = 'Pacient';
        document.getElementById('examList').innerHTML = '<div class="no-exams">Chyba: nie ste prihlásený.</div>';
        return;
    }

    // Load exams
    try {
        const examsResp = await axios.get(`/patients/${patient.id}/examinations`);
        const exams = examsResp && examsResp.data ? examsResp.data : [];

        if (!exams || exams.length === 0) {
            document.getElementById('examList').innerHTML = '<div class="no-exams">Zatiaľ nemáte žiadne vyšetrenia.</div>';
            return;
        }

        document.getElementById('examList').innerHTML = exams.map(e => {
            const date = e.created_at ? new Date(e.created_at.replace(' ', 'T')).toLocaleDateString('sk-SK') : '';
            const doctorName = e.doctor ? (e.doctor.name || '') : '';
            const doctorSurname = e.doctor ? (e.doctor.surname || '') : '';
            const doctorFull = [doctorName, doctorSurname].filter(x => x).join(' ') || 'Neznámy';

            let statusClass = '';
            if (e.result === 'positive') statusClass = 'status-positive';
            else if (e.result === 'negative') statusClass = 'status-negative';
            else statusClass = 'status-unknown';

            const photoVal = e.photo_url || e.photo || '';
            const notes = e.notes || '';

            return `
            <div class="exam-item">
                <div class="exam-info">
                    <div class="exam-date">${date}</div>
                    <h4 class="exam-name">Vyšetrenie #${e.id}</h4>
                    <p class="exam-status ${statusClass}">${e.result ? e.result : 'N/A'}</p>
                    <div style="font-size:0.9rem;color:#6b7280;margin-top:6px;">Doktor: ${doctorFull}</div>
                    ${notes ? `<div class="exam-notes">Poznámka: ${notes}</div>` : ''}
                </div>
                <a class="exam-link" href="#" data-photo="${photoVal}">Zobraziť</a>
            </div>
            `;
        }).join('');

        // Attach click handlers
        document.querySelectorAll('.exam-link').forEach(link => {
            link.onclick = function(ev) {
                ev.preventDefault();
                let url = this.getAttribute('data-photo') || '';

                if (!url) {
                    showImageModal(null);
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
                    showImageModal(null);
                }
            };
        });

    } catch (err) {
        console.error('Error loading exams:', err);
        document.getElementById('examList').innerHTML = '<div class="no-exams">Chyba pri načítaní vyšetrení.</div>';
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    loadPatientData();
});

