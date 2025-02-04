🎮 Herní Sklad

📌 Popis projektu

Tento projekt je webová aplikace pro správu uživatelských účtů s možností přihlášení, registrace a administrace. Administrátoři mohou spravovat uživatele, provádět soft a hard mazání, a obnovovat smazané účty.

🚀 Funkce

✅ Registrace a přihlášení uživatelů

✅ Role-based systém (uživatelé a admini)

✅ Administrátorský panel

Zobrazení seznamu uživatelů

Soft delete (dočasné smazání)

Hard delete (trvalé smazání)

Obnovení smazaných uživatelů

✅ Responzivní design s využitím Bootstrapu

📂 Struktura souborů

📁 projektos/
│── 📁 includes/
│   ├── db.php           # Připojení k databázi
│── 📁 pages/
│   ├── admin_dashboard.php # Administrátorský panel
│   ├── dashboard.php    # Uživatelský dashboard
│── 📁 css/
│   ├── style.css        # Hlavní stylování
│── index.php            # Přihlášení
│── register.php         # Registrace uživatele
│── README.md            # Dokumentace

⚙️ Instalace a spuštění

Naklonujte repozitář

git clone https://github.com/tvuj-username/projektos.git
cd projektos

Nastavte databázi

Vytvořte MySQL databázi

Naimportujte soubor database.sql (pokud je k dispozici)

Upravte includes/db.php s vašimi přihlašovacími údaji

Spusťte projekt v Laragonu nebo XAMPP

Ujistěte se, že běží Apache a MySQL

Otevřete http://localhost/projektos v prohlížeči

🛠️ Technologie

PHP 8+ – serverová logika

MySQL – databáze

Bootstrap 5 – stylování

Laragon/XAMPP – lokální server

📜 Licence

Tento projekt je open-source. Použijte ho, jak potřebujete! 😊

