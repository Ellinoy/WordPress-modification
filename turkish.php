<?php
	
     function getdata()
    {
$realdata = file_get_contents("https://covid19.saglik.gov.tr/?lang=tr-TR"); //забираем с сайта, куда ежедневно выкладываются данные код

        $testMadeOverall = $realdata; //показывает сколько всего тестов за все время
        $pos = strpos($testMadeOverall, '<span class="">');
        $testMadeOverall = substr($testMadeOverall, $pos);
        $pos = strpos($testMadeOverall, '</span>');
        $testMadeOverall = substr($testMadeOverall, 0, $pos);

        $ill = $realdata; //сколько всего заболевших за все время
        $pos = strpos($ill, 'TOPLAM<br>HASTA');
        $ill = substr($ill, $pos);
        $pos = strpos($ill, '</li>');
        $ill = str_replace('TOPLAM<br>HASTA<br>SAYISI', '', $ill);
        $ill = substr($ill, 0, $pos);

        $dead = $realdata; //сколько всего умерших от ковид-19
        $pos = strpos($dead, 'TOPLAM<br>VEFAT<br>SAYISI');
        $dead = substr($dead, $pos);
        $pos = strpos($dead, '</li>');
        $dead = str_replace('TOPLAM<br>VEFAT<br>SAYISI', '', $dead);
        $dead = substr($dead, 0, $pos);

        $heavy = $realdata; //сколько находятся в тяжелом состоянии
        $pos = strpos($heavy, 'AĞIR<br>');
        $heavy = substr($heavy, $pos);
        $pos = strpos($heavy, '</li>');
        $heavy = str_replace('AĞIR<br>HASTA<br>SAYISI', '', $heavy);
        $heavy = substr($heavy, 0, $pos);

        $ivl = $realdata; //сколько заболели пневмонией в %
        $pos = strpos($ivl, 'HASTALARDA<br>ZATÜRRE<br>ORANI (%)');
        $ivl = substr($ivl, $pos);
        $pos = strpos($ivl, '</li>');
        $ivl = str_replace('HASTALARDA<br>ZATÜRRE<br>ORANI (%)', '', $ivl);
		$ivl = str_replace('%', '', $ivl);
        $ivl = substr($ivl, 0, $pos);

        $healed = $realdata; //сколько выздоровели за все время
        $pos = strpos($healed, 'TOPLAM<br>İYİLEŞEN<br>HASTA SAYISI');
        $healed = substr($healed, $pos);
        $pos = strpos($healed, '</li>');
        $healed = str_replace('TOPLAM<br>İYİLEŞEN<br>HASTA SAYISI', '', $healed);
        $healed = substr($healed, 0, $pos);

        $testperday = $realdata; //сколько тестов сделано за день
        $pos = strpos($testperday, 'BUGÜNKÜ<br>TEST<br>SAYISI');
        $testperday = substr($testperday, $pos);
        $pos = strpos($testperday, '</li>');
        $testperday = str_replace('BUGÜNKÜ<br>TEST<br>SAYISI', '', $testperday);
        $testperday = substr($testperday, 0, $pos);

        $illperday = $realdata; //сколько за день заболело
        $pos = strpos($illperday, 'BUGÜNKÜ<br>HASTA<br>SAYISI');
        $illperday = substr($illperday, $pos);
        $pos = strpos($illperday, '</li>');
        $illperday = str_replace('BUGÜNKÜ<br>HASTA<br>SAYISI', '', $illperday);
        $illperday = substr($illperday, 0, $pos);

        $deadperday = $realdata; //сколько за день умерло
        $pos = strpos($deadperday, 'BUGÜNKÜ<br>VEFAT<br>SAYISI');
        $deadperday = substr($deadperday, $pos);
        $pos = strpos($deadperday, '</li>');
        $deadperday = str_replace('BUGÜNKÜ<br>VEFAT<br>SAYISI', '', $deadperday);
        $deadperday = substr($deadperday, 0, $pos);

        $healedperday = $realdata; //сколько за день выздоровело
        $pos = strpos($healedperday, 'BUGÜNKÜ<br>İYİLEŞEN<br>SAYISI');
        $healedperday = substr($healedperday, $pos);
        $pos = strpos($healedperday, '</li>');
        $healedperday = str_replace('BUGÜNKÜ<br>İYİLEŞEN<br>SAYISI', '', $healedperday);
        $healedperday = substr($healedperday, 0, $pos);

        return ['testMadeOverall' => $testMadeOverall, "ill" => $ill, "illperday" => $illperday, "healed" => $healed, "healedperday" => $healedperday, "testperday" => $testperday, "dead" => $dead, "deadperday" => $deadperday, "heavy" => $heavy, "ivl" => $ivl];
    }

    
    function write_results() //функция для вывода полученных данных в виде таблицы
    {

        $html = '<div style="background-color:#FFFFFF;color:#121D82"><table><b><tr> </tr><tr>';
        $html.= "Статистика борьбы с COVID-19 в Турции на " . date('d.m');
		$html.= "</tr><tr>";
		$names = ['testMadeOverall' => "Всего тестов: ", 'testperday' => "Тестов в день: ", 'ill' => "Всего больных: ", "illperday" => "Больных за день: ", "healed" => "Вылечилось: ", "healedperday" => "Вылечилось за день: ", "dead" => "Умерло: ", "deadperday" => "Умерло за день: ", "heavy" => "В тяжелом состоянии: ", "ivl" => "Заболело пневмонией (%) "];
        try
        {
            $data = getdata();


            foreach ($data as $key => $value) $html .= "<td> " . $names[$key] . " " . $value . "</td>";
        }
        catch(Exception $e)
        {
            $html .= "Ошибка загрузки данных";
        }

        $html .= '</tr></table><br><br></div>';

        return $html;

    }

echo write_results();
