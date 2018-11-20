<?php 
            $jour =     date("d"); 
            $mois =     date("m"); 
            $annee =    date("Y");
             ?>
<td><p> Le 

 <select name="day" id="day">
        <?php for ($i = 1; $i < 31; $i++) {
            if ($i < 10) {
                $zero = '0';
            } else {
                $zero = '';
            }
            echo "<option value='" . $zero . $i . "'>$i</option>";
        } ?>
    </select> 

    / 

    <select name="month" id="month">
        <?php for ($i = 0; $i <= 11; $i++) {
             $value=$i+1;
            if ($value < 10) {
                $zero = '0';
            } else {
                $zero = '';
            }

            $month = ['janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre'];
            echo "<option value='" . $zero . $value . "'>$month[$i]</option>";
        } ?>
    </select> 

    /

    <select name="year" id="year">
        <?php for ($i = 2019; $i < 2022; $i++) {
            echo "<option value='$i'>$i</option>";
        } ?>
    </select>

           a

       <select name="hours" id="hours">
        <?php for ($i = 0; $i < 24; $i++) {
             if ($i < 10) {
                $zero = '0';
            } else {
                $zero = '';
            }
            echo "   <option value=' " . $zero . $i . "'>" . $zero . $i . "</option>";
        } ?>
    </select> 

    heure

       <select name="minutes" id="minutes">
        <?php for ($i = 0; $i < 60; $i++) {
             if ($i < 10) {
                $zero = '0';
            } else {
                $zero = '';
            }
            echo "<option value='" . $zero . $i . "'>" . $zero . $i . "</option>";
        } ?>
    </select>
    minutes
    </p>
</td>