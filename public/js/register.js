document.addEventListener('DOMContentLoaded', function () {
    const typeDoktor = document.getElementById('typeDoktor');
    const typePacient = document.getElementById('typePacient');
    const doktorFields = document.getElementById('doktorFields');
    const pacientFields = document.getElementById('pacientFields');
    const registerForm = document.getElementById('registerForm');

    // Funkcia na prepínanie typov
    function toggleAccountType() {
        if (typeDoktor.checked) {
            doktorFields.style.display = 'block';
            pacientFields.style.display = 'none';

            // Required pre doktora
            document.getElementById('dikter_id').required = true;

            // Nie required pre pacienta
            document.getElementById('rodne_cislo').required = false;
            document.getElementById('datum_narodenia').required = false;
        } else {
            doktorFields.style.display = 'none';
            pacientFields.style.display = 'block';

            // Required pre pacienta
            document.getElementById('rodne_cislo').required = true;
            document.getElementById('datum_narodenia').required = true;

            // Nie required pre doktora
            document.getElementById('dikter_id').required = false;
        }
    }

    // Event listenery pre zmenu typu
    if(typeDoktor && typePacient) {
        typeDoktor.addEventListener('change', toggleAccountType);
        typePacient.addEventListener('change', toggleAccountType);
        // Spustiť raz pri načítaní pre nastavenie východzieho stavu
        toggleAccountType();
    }

    // Validácia a odoslanie formulára
    if(registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirm').value;

            if (password !== passwordConfirm) {
                alert('Heslá sa nezhodujú!');
                return;
            }

            if (password.length < 8) {
                alert('Heslo musí mať aspoň 8 znakov!');
                return;
            }

            const isDoctor = typeDoktor.checked;
            const payload = {
                name: (document.getElementById('meno').value || '') + ' ' + (document.getElementById('priezvisko').value || ''),
                email: document.getElementById('email').value,
                password: password,
                password_confirmation: passwordConfirm,
                is_doctor: isDoctor,
                telefon: document.getElementById('telefon').value || null,
            };

            if (isDoctor) {
                payload.dikter_id = document.getElementById('dikter_id').value || null;
                payload.specializacia = document.getElementById('specializacia').value || null;
                payload.pracovisko = document.getElementById('pracovisko').value || null;
            } else {
                payload.rodne_cislo = document.getElementById('rodne_cislo').value || null;
                payload.datum_narodenia = document.getElementById('datum_narodenia').value || null;
            }

            try {
                // Použijeme globálny axios (z CDN alebo window) alebo fetch
                let response;
                // Skontrolujeme či je axios dostupný globálne
                if (window.axios) {
                    response = await window.axios.post('/api/register', payload);
                } else {
                    response = await fetch('/api/register', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });
                }

                // Spracovanie odpovede (normalizácia pre fetch/axios)
                let status = response.status;
                let data = response.data; // Axios

                if (!data && typeof response.json === 'function') {
                    data = await response.json(); // Fetch
                }

                if (status === 201) {
                    alert('Registrácia prebehla úspešne. Prosím prihláste sa.');
                    window.location.href = '/prihlasenie';
                } else {
                    // Chybové stavy
                    const errors = data.errors || data;
                    let messages = [];
                    if(typeof errors === 'object') {
                        for (const key in errors) {
                            if (Array.isArray(errors[key])) messages = messages.concat(errors[key]);
                            else if (typeof errors[key] === 'string') messages.push(errors[key]);
                        }
                        alert('Chyby pri registrácii:\n' + messages.join('\n'));
                    } else {
                        alert('Chyba pri registrácii.');
                    }
                }
            } catch (err) {
                console.error('Registration error:', err);
                let errorMsg = 'Chyba pri komunikácii so serverom.';
                if (err.response && err.response.data) {
                    const errors = err.response.data.errors || err.response.data;
                    errorMsg += '\n' + JSON.stringify(errors);
                }
                alert(errorMsg);
            }
        });
    }
});
