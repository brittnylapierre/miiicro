<h1>search bar!</h1>
<form action="search.php" method="GET">
	<input type="text" name="keywords" />
	<input type="submit" value="Search" />
</form>



<?php if (array_key_exists('keyword', $params)): ?>

  <h3><?php print $params['keyword'];?></h3>

<?php 
  try {
  
    $request = curl_init();

    $url = get_option('bl_url', $params['id']) . "/catalog.json?utf8=%E2%9C%93&search_field=all_fields&q=" . $params['keyword'];

    $options = array(
      CURLOPT_URL => $url,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($request, $options);
    $result = curl_exec($request);
    $json = json_decode($result, true);

    if( array_key_exists('data', $json) ) {
      foreach ($json['data'] as $value) {

        if( array_key_exists ( 'attributes', $value ) ) {
          if( array_key_exists ( 'title_tsim', $value['attributes'] ) && 
              array_key_exists ( 'attributes', $value['attributes']['title_tsim'] ) &&
              array_key_exists ( 'value', $value['attributes']['title_tsim']['attributes'] )
            ){
              print '<a href="/iiif?id=b18035723"><h4>' . $value['attributes']['title_tsim']['attributes']['value'] . '</h4></a>';
            }
        }


        if( array_key_exists ( 'type', $value ) ) {
          print '<h5>' . $value['type'] . '</h5>';
        }

      }
    }
    curl_close($request);
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
?>


<?php endif; ?>