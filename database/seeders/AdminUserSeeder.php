<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pôvodné dáta admina, ktoré sa používajú na nájdenie riadku:
        $original_email = 'admin@mamography.sk';

        // NOVÉ DÁTA, KTORÉ CHCETE NASTAVIŤ:
        $new_email = 'mamo@sk'; // TOTO JE VÁŠ NOVÝ E-MAIL
        $new_password = '12345678';     // TOTO JE VÁŠ NOVÉ, JEDNODUCHÉ HESLO

        // 1. Nájdeme Admina podľa pôvodného e-mailu
        $admin = User::where('email', $original_email)->first();

        if ($admin) {
            // 2. Ak Admin existuje, aktualizujeme mu údaje
            $admin->email = $new_email;
            $admin->password = Hash::make($new_password);
            // Ak chcete zmeniť meno:
            // $admin->name = 'Super Admin';

            $admin->save();
            $this->command->info("Admin bol úspešne aktualizovaný na $new_email.");
        } else {
            // Ak neexistuje, môžete ho vytvoriť (pôvodná logika seederu)
            // Môžete tu nechať pôvodný kód, ak ho potrebujete
            $this->command->error("Admin s e-mailom $original_email nebol nájdený. Žiadna aktualizácia neprebehla.");
        }
    }
}
