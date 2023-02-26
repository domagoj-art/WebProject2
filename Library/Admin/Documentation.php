<?php
$title = "Documentation";
require_once("../Templates/AdminHeader.php");
?>
<div class="responsiveContainer">
    <div class="doc">
        <h1>Documentation</h1>
        <h2>Opis projektnog Zadatka</h2>
        <p>Kreirati program u web razvojnom okruženju koji služi za evidenciju knjiga u knjižnici. Koristeći  zadani izvor podataka potrebno je dodavati, prikazati, izmjenjivati i brisati podatke. Program treba imati slijedeće funkcionalnosti</p>
        <p>Prikaz svih knjiga </p>
        <p>Dodavanje knjige </p>
        <p>Brisanje knjige </p>
        <p>Evidencija članova knjižnice </p>
        <p>Najam knjige </p>
        <h2>Opis projektnog riješenja</h2>
        <p>S ovime projektnim rješenjem riješio sam gore navedene probleme tj korisnik može iznajmiti knjigu, pregledati katalog i vratiti knjigu, a admin može dodati i izbrisati knjigu i članove. Projekt sam napravio s php, JavaScript, html, css za bazu podataka sam koristio phpMyAdmin.</p>
        <h2>Dijagram slučajeva korištenja</h2>
        <img src="../Images/UseCaseDiagram.png" alt="Dijagram slučajeva korištenja">
        <h2>ER dijagram baze podataka</h2>
        <img src="../Images/Library.jpg" alt="ER dijagram baze podataka">
        <h2>Popis mapa i datoteka</h2>
        <h3>Mape:</h3>
        <p>Admin</p>
        <p>Class</p>
        <p>Database</p>
        <p>Images</p>
        <p>JavaScript</p>
        <p>Logout</p>
        <p>Styles</p>
        <p>Templates</p>
        <p>User</p>
        <p>Visitors</p>
        <p>ActivateAccount</p>
        <p>ContactMe</p>
        <p>Login</p>
        <p>SingnUp</p>
        <h3>Datoteke:</h3>
        <p>Author</p>
        <p>BooksRecord</p>
        <p>BooksRecordFunctions</p>
        <p>Documentation</p>
        <p>IndexFunctions</p>
        <p>Index</p>
        <p>Logs</p>
        <p>LogsFunctions</p>
        <p>RecoverData</p>
        <p>RecoverDataFunctions</p>
        <p>Session</p>
        <p>Statistics</p>
        <p>StatisticsFunctions</p>
        <p>UserAdministration</p>
        <p>UserAdministrationFunctions</p>
        <p>WebConfig</p>
        <p>BookClass</p>
        <p>LogsClass</p>
        <p>PaginationClass</p>
        <p>UserClass</p>
        <p>Connection</p>
        <p>Library</p>
        <p>MyPicture</p>
        <p>OpenBook3</p>
        <p>UseCaseDiagram</p>
        <p>UserBackground</p>
        <p>Ajax</p>
        <p>ClientValidation</p>
        <p>jquery</p>
        <p>ResponsiveNavbar</p>
        <p>Logout</p>
        <p>AdminStyle</p>
        <p>IndexStyle</p>
        <p>UserStyle</p>
        <p>VisitorsStyle</p>
        <p>AdminFooter</p>
        <p>AdminHeader</p>
        <p>IndexHeader</p>
        <p>UserFooter</p>
        <p>UserHeader</p>
        <p>VisitorsFooter</p>
        <p>VisitorsHeader</p>
        <p>Archive</p>
        <p>ArchiveFunctions</p>
        <p>BooksFunctions</p>
        <p>Index</p>
        <p>Sessino</p>
        <p>ActivateAccount</p>
        <p>Functions</p> 
        <p>ContactMe</p> 
        <p>Functions</p> 
        <p>Login</p> 
        <p>Functions</p> 
        <p>CheckAvailability</p> 
        <p>Functions</p> 
        <p>ServerValidation</p> 
        <p>SingnUp</p>
        <p>GetData</p>
        <p>Index</p>
        <p>Rss</p>
        <h2>Popis Uočenih problema u radu</h2>
        <p>1. Nije potpuno respoznivna samo neke stranice su resposnzivne</p>
        <p>2. Nisam implementirao live search</p>
        <p>3. Nije do kraja stilizirana</p>
        <p>5. Nije korišten grid</p>
        <p>6. Statisiku se ne može pretraživati po vremenskom intervalu </p>
        <p>7. Krivi chart sam koristio pa je cudna prikaz</p>
        <p>8. kada admin updatea korisnika promjeni mu sifru na kriptiranui zapis</p>
        <p>9. tablice se ne refresaju same</p>
        <p>10.zaštita od ubacivanja sql nije svuda implementirana</p>
        <p>11. https mislim da ne radi </p>

    </div>
</div>


<?php
require_once("../Templates/AdminFooter.php");
?>