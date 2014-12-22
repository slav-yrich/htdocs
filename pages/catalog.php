
			<div class="row-fluid">
				<div class="span6">
					<h1>Каталог</h1>
				<ul class="thumbnails newBooks">
					<div class="clearfix">
						<?php

$query = "SELECT * FROM category";
$result = pg_query($query)  /*or die(pg_error())*/ ;
if   (pg_num_rows($result) > 0){
    $cats = array();
    while($cat =  pg_fetch_assoc($result)){
        $cats_ID[$cat['id']][] = $cat;
        $cats[$cat['parent_id']][$cat['id']] =  $cat;
    }
}
function build_tree($cats,$parent_id,$only_parent = false){
    if(is_array($cats) and isset($cats[$parent_id])){
           $tree = '<ul class="sub-menu">';
        if($only_parent==false){
            foreach($cats[$parent_id] as $cat){
                $tree .= '<li >'.'<p class="title">'.'<a class="title" href="/index.php?p=category&num_cat='.$cat['id'].'">'.$cat['category_name'].'</a>'.'</p>';
                $tree .=  build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }
        }elseif(is_numeric($only_parent)){
            $cat = $cats[$parent_id][$only_parent];
            $tree .= '<li>'.'<p class="title">'.'<a class="title" href="/index.php?p=category&num_cat='.$cat['id'].'">'.$cat['category_name'].'</a>'.'</p>';
            $tree .=  build_tree($cats,$cat['id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    }
    else return null;
    return $tree;
}
echo build_tree($cats,0);

/*for ($i=1; $i <= pg_num_rows($sql) ; $i++) {
  $row =pg_fetch_array($sql);

if ($row['parent_id'] == '0') {
echo '<li class="active">'.'<a class="years" href="http://kursach.ru/finalcategory.php?num_cat='.$row['id'].'">'.$row['category_name'].'</a>'.'</li>';}
$query3 = "SELECT * FROM category WHERE parent_id =".$row['parent_id'];
  $sql3= pg_query($query3) or die(pg_error());
  $row3 =pg_fetch_array($sql3);

if (isset($row3)) {
  echo '<ul>';

  for ($j=$i; $j<= pg_num_rows($sql3) ; $j++) {
    $row3 =pg_fetch_array($sql3);
    echo '<li>'.'<a class="years" href="http://kursach.ru/finalcategory.php?num_cat='.$row3['id'].'">'.$row3['category_name'].'</a>'.'</li>';
    $sql3= pg_query($query3) or die(pg_error());
  }
  echo '</ul>';

}


pg_query($query) or die(pg_error());
}*/ ?>

</div>
					</ul>

				</div>





					</div>


				</div>