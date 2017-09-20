<a href=write.php>글쓰기</a>

<table width=450 border=1>
<?
include "connect.php"; // mySQL에 접속

//페이징처리를 위한 구문
$query = "SELECT COUNT(*) FROM bbs"; // 갯수세기 쿼리문
$result = mysql_query ($query, $connect); // 쿼리문 입력
$total = mysql_result ($result, 0, 0); // 총 갯수 저장
$page = 10; // 페이지당 게시물 갯수
$pagesu = ceil ($total / $page); // 전체 페이지 갯수
$start = $page * $pagenum; // 시작위치

$number = $total - ($pagenum * $page); // 현재 페이지의 시작 글 번호

$query = "SELECT * FROM bbs ORDER BY family, orderby LIMIT $start,$page"; //bbs의 글 가져오기
$result = mysql_query ($query, $connect); // 글 꺼내기
while ($data = mysql_fetch_array ($result)) {
$data[name] = stripslashes ($data[name]); // 이름의 \제거
$data[title] = stripslashes ($data[title]); // 제목의 \제거

if ($data[step]) {$re = "re";} //step에 값이 있다는 것을 리플을 의미하므로 앞에 re를 붙여주자
else {$re = "";}

$blank="";
for ($i = 0; $i < $data[step]; $i++) {//step이 2이상이면 답변의 답변이므로 글목록을 좀더 안쪽으로 배치하기 위하여 공백문자를 더해주자
$blank .= "&nbsp;";
}

echo "<tr> //리스트에 보여주고자 하는 것을 출력하자 no, title, name, hit
<td width=1% nowrap>$number</td>
<td width=97%>$blank$re<a href=view.php?no=$data[no]>$data[title]</a>
</td>
<td width=1% nowrap>$data[name]</td>
<td width=1% nowrap>$data[hit]</td>
</tr>";


$number--; // 글 번호 감소
}
?>
<table>


<?
$pagegroup = 5; // 페이지 그룹당 페이지 수
$pageend = $pagestart +$pagegroup; // 페이지 그룹의 마지막 페이지
$pagegroupnum = ceil(($pagenum + 1) / $pagegroup); // 현재의 페이지 그룹
$pagestart = ($pagegroupnum - 1) * $pagegroup + 1; // 페이지 그룹의 첫 페이지
$pageend = $pagestart +$pagegroup - 1; // 페이지 그룹의 마지막 페이지

$prevgroup = $pagegroupnum - 1; // 이전 그룹
$prevstart = ($prevgroup - 1) * $pagegroup; // 이전 페이지 그룹의 첫 페이지
if ($pagegroupnum != 1) { // 이전 페이지 그룹으로 이동
echo "[<a href='$PHP_SELF?pagenum=$prevstart'>◀◀</a>] ";
}

for ($i = $pagestart; $i <= $pageend; $i++) { // 페이지 이동 버튼 출력
if ($i > $pagesu) {break;} // 페이지 체크
$j = $i - 1; // 넘겨줄 $pagenum
echo "[<a href='$PHP_SELF?pagenum=$j'>$i</a>] "; 
}


$nextgroup = $pagegroupnum + 1; // 다음 그룹
$nextstart = ($nextgroup - 1) * $pagegroup; // 다음 페이지 그룹의 첫 페이지
if ($pagesu > ($nextstart + 1)) { // 다음 페이지 그룹으로 이동
echo " [<a href='$PHP_SELF?pagenum=$nextstart'>▶▶</a>]";
}
?>