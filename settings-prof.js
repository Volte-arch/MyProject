const Setting_prof = ()=>{
    return(
        <>
            <div class="closesetting"></div> 
            <div class="Veryfication-account">
                <h2>Pozostały czas werfikacji konta: --</h2>
                <h3> <input type="button" value="wyśli ponownie"/></h3>
            </div>
            <div class="Edit-Phone">
                <h2>Dodaj telefon</h2>
                <input type="text"/>
            </div>
            <div class="Edit-Nickname">
                <h2>Pseudonim - zmiana co 7dni</h2>
                <h3> (Klikni)</h3>
            </div>
            <div class="Added-name-and-lastname">
                <h3>Brak imienia (klikni)</h3>
                <h3>Brak nazwiska (klikni)</h3>
            </div>
            <button name="save">Zapisz dane</button>
        </>
    )
}

window.Setting_prof = Setting_prof;