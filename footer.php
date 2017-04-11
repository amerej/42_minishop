<footer>
	<h4>

<?PHP
if (!file_exists("stats"))
	mkdir("stats");
if (!file_exists("stats/visitor"))
	file_put_contents("stats/visitor", "0");
$n = file_get_contents("stats/visitor");
if (!is_numeric($n) || $n < 0)
{
	file_put_contents("stats/visitor", "0");
	$n = 0;
}
echo "You're the ".$n;
echo "th junkie on <span id=\"dotdrug\" ><span style=\"color: #707070;\" >Dot </span>Drug</span> since April 2017";
file_put_contents("stats/visitor", $n + "1");
?>

</h4>
</footer>
