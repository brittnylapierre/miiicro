<form action="search.php" method="GET">
  <div class="input-group mb-3">
    <input type="text" name="keywords" class="form-control" placeholder="" aria-label="Search the harvard repository" aria-describedby="button-addon2">
    <button class="btn btn-primary" type="submit" value="Search" id="button-addon2">Search</button>
  </div>
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

    if( array_key_exists('response', $json) &&  array_key_exists('docs', $json['response'] )) {
      foreach ($json['response']['docs'] as $value) {

        if( array_key_exists ( 'title_extended', $value ) ) {
          
          if( array_key_exists ('drs_file_id', $value) && 
          array_key_exists ('delivery_service', $value) && strlen($value['drs_file_id']) > 0 ) {
            print '<a href="/iiif?id=' . ($value['delivery_service'] == "ids" ? "ids" : "drs") . ':' . $value['drs_file_id'] . '"><h4>' . $value['title_extended'] . '</h4></a>';
          } else {
            print '<h4>' . $value['title_extended'] . '</h4>';
          }
          
            
        }


        if( array_key_exists ( 'type', $value ) ) {
          print '<h5>' . $value['type'] . '</h5>';
        }

      }
    }
    
    /*if( array_key_exists('data', $json) ) {
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
    }*/
    curl_close($request);
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
?>


<?php endif; ?>