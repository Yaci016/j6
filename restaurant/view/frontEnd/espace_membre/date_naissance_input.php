<?php
/**
 * Created by PhpStorm.
 * User: wali7
 * Date: 13/11/18
 * Time: 10:11
 */ ?>
<td>
    <select name="day" id="day">
        <option value="1">1</option>
        <?php for ($i = 2; $i < 31; $i++) {
            echo "<option value='$i'>$i</option>";
        } ?>
    </select> / <select name="month" id="day">
        <option value="01">janvier</option>
        <?php for ($i = 1; $i < 12; $i++) {
            if ($i < 10) {
                $zero = '0';
            } else {
                $zero = '';
            }
            $month = ['janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre'];
            echo "<option value='$zero.$i'>$month[$i]</option>";
        } ?>
    </select> /<select name="year" id="day">
        <option value="1939">1939</option>
        <?php for ($i = 1940; $i < 2000; $i++) {
            echo "<option value='$i'>$i</option>";
        } ?>
    </select>
</td>