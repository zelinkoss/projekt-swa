# 🎮 Herní Sklad

## 📌 Popis projektu
Tento projekt je webová aplikace pro správu uživatelských účtů s možností registrace, přihlášení a administrace. Administrátoři mohou spravovat uživatele, provádět soft a hard mazání a obnovovat smazané účty.

## 🚀 Funkce
- 🔹 Registrace a přihlášení uživatelů
- 🔹 Role-based systém (uživatelé a administrátoři)
- 🔹 Administrátorský panel:
  - Zobrazení seznamu uživatelů
  - Soft delete (dočasné smazání účtu)
  - Hard delete (trvalé smazání účtu)
  - Obnovení smazaných uživatelů
- 🔹 Responzivní design s využitím Bootstrapu

## 📂 Struktura souborů
```
📁 proejkt1/
│── 📁 includes/
│   ├── db.php             # Připojení k databázi
│── 📁 pages/
│   ├── admin_dashboard.php # Administrátorský panel
│   ├── dashboard.php       # Uživatelský dashboard
│── 📁 css/
│   ├── style.css          # Hlavní stylování
│── index.php              # Přihlášení
│── register.php           # Registrace uživatele
│── README.md              # Dokumentace
```

## ⚙️ Instalace a spuštění
1. **Naklonujte repozitář**
   ```sh
   git clone https://github.com/tvuj-username/projekt-swa.git
   cd proejkt-swa
   ```
2. **Nastavte databázi**
   - Vytvořte MySQL databázi
   - Naimportujte soubor `database.sql` (pokud je k dispozici)
   - Upravte `includes/db.php` s vašimi přihlašovacími údaji

3. **Spusťte projekt v Laragonu nebo XAMPP**
   - Ujistěte se, že běží Apache a MySQL
   - Otevřete `http://localhost/projektos` v prohlížeči

## 🛠️ Použité technologie
- **PHP 8+** – serverová logika
- **MySQL** – databáze
- **Bootstrap 5** – stylování
- **Laragon/XAMPP** – lokální server

## 📜 Licence

## ER Diagram
![image](https://github.com/user-attachments/assets/9eaf4684-ff7d-4ce8-9d3f-86010a4cae19)

Tento projekt je open-source. Použijte ho, jak potřebujete! 😊

