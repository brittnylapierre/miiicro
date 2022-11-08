<?php if (array_key_exists('document_id', $params)): ?>

  <h3><?php print $params['document_id'];?></h3>
  <div class="uv" id="uv"></div>
  <script>
    const data = {
      manifest: "<?php print get_option('iiif_url', $params['id']) . $params['document_id'];?>/manifest",
      embedded: true // needed for codesandbox frame
    };

    uv = UV.init("uv", data);
  </script>


<?php endif; ?>