<?php if (array_key_exists('document_id', $params)): ?>
  <div class="row justify-content-center align-items-center">
    <div class="col-lg text-center">
      <script
        type="application/javascript"
        src="https://cdn.jsdelivr.net/npm/universalviewer@4.0.0/dist/umd/UV.js"
      ></script>

      <!--h3><?php print $params['document_id'];?></h3>
      <h4><?php print get_option('iiif_url', $params['id']) . "/" . $params['document_id'];?></h4-->

      <div class="container px-4 py-5 element" id="icon-grid">
  
        <div class="row row-cols-1 py-5">
            <div class="col d-flex align-items-center">
              <div class="uv" id="uv"></div>
            </div>
        </div>
    </div>

      
      <script>
        
        /**get_option('iiif_url', $params['id']) . "/" . $params['document_id'];?>/manifest"*/
        const data = {
          manifest: "<?php print get_option('iiif_url', $params['id']) . '/' . $params['document_id']?>",
          embedded: true // needed for codesandbox frame
        };

        uv = UV.init("uv", data);

        // override config using an inline json object
        uv.on("configure", function ({ config, cb }) {
          cb({
            "options": {
              "allowStealFocus": false,
              "authAPIVersion": 1,
              "bookmarkThumbHeight": 150,
              "bookmarkThumbWidth": 90,
              "dropEnabled": true,
              "footerPanelEnabled": true,
              "headerPanelEnabled": true,
              "leftPanelEnabled": true,
              "limitLocales": false,
              "metrics": [
                {
                  "type": "sm",
                  "minWidth": 0
                },
                {
                  "type": "md",
                  "minWidth": 768
                },
                {
                  "type": "lg",
                  "minWidth": 1024
                },
                {
                  "type": "xl",
                  "minWidth": 1280
                }
              ],
              "multiSelectionMimeType": "application/zip",
              "navigatorEnabled": true,
              "openTemplate": "http://universalviewer.io?manifest={0}",
              "overrideFullScreen": false,
              "pagingEnabled": true,
              "pagingOptionEnabled": true,
              "pessimisticAccessControl": false,
              "preserveViewport": false,
              "rightPanelEnabled": true,
              "saveUserSettings": false,
              "clickToZoomEnabled": true,
              "searchWithinEnabled": true,
              "termsOfUseEnabled": true,
              "theme": "uv-en-GB-theme",
              "tokenStorage": "session",
              "useArrowKeysToNavigate": false,
              "zoomToSearchResultEnabled": true,
              "zoomToBoundsEnabled": true
            },
            "modules": {
              "contentLeftPanel": {
                "options": {
                  "autoExpandTreeEnabled": false,
                  "autoExpandTreeIfFewerThan": 20,
                  "branchNodesExpandOnClick": true,
                  "branchNodesSelectable": false,
                  "defaultToTreeEnabled": false,
                  "defaultToTreeIfGreaterThan": 0,
                  "elideCount": 40,
                  "expandFullEnabled": true,
                  "galleryThumbChunkedResizingThreshold": 400,
                  "galleryThumbHeight": 320,
                  "galleryThumbLoadPadding": 3,
                  "galleryThumbWidth": 200,
                  "oneColThumbHeight": 320,
                  "oneColThumbWidth": 200,
                  "pageModeEnabled": true,
                  "panelAnimationDuration": 250,
                  "panelCollapsedWidth": 30,
                  "panelExpandedWidth": 255,
                  "panelOpen": true,
                  "tabOrder": "",
                  "thumbsCacheInvalidation": {
                    "enabled": true,
                    "paramType": "?"
                  },
                  "thumbsEnabled": true,
                  "thumbsExtraHeight": 8,
                  "thumbsImageFadeInDuration": 300,
                  "thumbsLoadRange": 15,
                  "treeEnabled": true,
                  "twoColThumbHeight": 150,
                  "twoColThumbWidth": 90
                },
                "content": {
                  "collapse": "Collapse Contents",
                  "collapseFull": "Collapse Gallery",
                  "date": "date",
                  "expand": "Expand Contents",
                  "expandFull": "Expand Gallery",
                  "index": "Index",
                  "manifestRanges": "Manifest Ranges",
                  "searchResult": "{0} search result",
                  "searchResults": "{0} search results",
                  "sortBy": "Sort By:",
                  "thumbnails": "Thumbnails",
                  "title": "Contents",
                  "volume": "volume"
                }
              },
              "dialogue": {
                "topCloseButtonEnabled": false,
                "content": {
                  "close": "Close"
                }
              },
              "downloadDialogue": {
                "options": {
                  "confinedImageSize": 1000,
                  "currentViewDisabledPercentage": 90,
                  "maxImageWidth": 5000,
                  "optionsExplanatoryTextEnabled": false,
                  "selectionEnabled": false
                },
                "content": {
                  "currentViewAsJpg": "Current view {0} x {1}px (jpg)",
                  "currentViewAsJpgExplanation": "Opens in a new window",
                  "download": "Download",
                  "downloadSelection": "Download Selection",
                  "downloadSelectionExplanation": "Opens a dialogue to select which pages to download.",
                  "editSettings": "Edit Settings",
                  "entireDocument": "Entire document ({0})",
                  "entireFileAsOriginal": "Entire file",
                  "noneAvailable": "No download options are available.",
                  "pagingNote": "Please turn off Two Page View for additional options.",
                  "preview": "Preview",
                  "title": "Download",
                  "wholeImageHighRes": "Whole image {0} x {1}px ({2})",
                  "wholeImageHighResExplanation": "Opens in a new window.",
                  "wholeImagesHighRes": "Whole images ({0})",
                  "wholeImagesHighResExplanation": "Opens in two new windows.",
                  "wholeImageLowResAsJpg": "Whole image {0} x {1}px (jpg)",
                  "wholeImageLowResAsJpgExplanation": "Opens in a new window."
                }
              },
              "footerPanel": {
                "options": {
                  "autocompleteAllowWords": false,
                  "bookmarkEnabled": false,
                  "downloadEnabled": true,
                  "embedEnabled": false,
                  "feedbackEnabled": false,
                  "fullscreenEnabled": true,
                  "minimiseButtons": true,
                  "moreInfoEnabled": true,
                  "openEnabled": false,
                  "printEnabled": false,
                  "shareEnabled": true
                },
                "content": {
                  "bookmark": "Add to bookmarks",
                  "download": "Download",
                  "embed": "Embed",
                  "exitFullScreen": "Exit Full Screen",
                  "feedback": "Feedback",
                  "fullScreen": "Full Screen",
                  "moreInfo": "More Information",
                  "open": "Open",
                  "share": "Share"
                }
              },
              "genericDialogue": {
                "content": {
                  "emptyValue": "please enter a value.",
                  "invalidNumber": "Please enter a valid number.",
                  "noMatches": "No matches were found.",
                  "ok": "OK",
                  "pageNotFound": "This item does not contain a page with the number you entered. Try switching the numbering mode to 'image'.",
                  "refresh": "Refresh"
                }
              },
              "headerPanel": {
                "options": {
                  "centerOptionsEnabled": true,
                  "localeToggleEnabled": false,
                  "settingsButtonEnabled": true
                }
              },
              "helpDialogue": {
                "content": {
                  "text": "placeholder text",
                  "title": "Help"
                }
              },
              "moreInfoRightPanel": {
                "options": {
                  "canvasDisplayOrder": "",
                  "canvasExclude": "",
                  "copyToClipboardEnabled": false,
                  "manifestDisplayOrder": "",
                  "manifestExclude": "",
                  "panelAnimationDuration": 250,
                  "panelCollapsedWidth": 30,
                  "panelExpandedWidth": 255,
                  "panelOpen": false,
                  "rtlLanguageCodes": "ar, ara, dv, div, he, heb, ur, urd",
                  "showAllLanguages": false,
                  "textLimit": 4,
                  "textLimitType": "lines"
                },
                "content": {
                  "attribution": "Attribution",
                  "canvasHeader": "About the image",
                  "collapse": "Collapse Information",
                  "collapseFull": "Collapse Gallery",
                  "copiedToClipboard": "Copied to clipboard",
                  "copyToClipboard": "Copy to clipboard",
                  "description": "Description",
                  "expand": "Expand Information",
                  "expandFull": "Expand Gallery",
                  "holdingText": "Your module goes here!",
                  "less": "less",
                  "license": "License",
                  "logo": "Logo",
                  "manifestHeader": "About the item",
                  "more": "more",
                  "noData": "No data to display",
                  "page": "Page",
                  "rangeHeader": "About this section",
                  "title": "More Information"
                }
              },
              "multiSelectDialogue": {
                "options": {
                  "galleryThumbChunkedResizingEnabled": true,
                  "galleryThumbChunkedResizingThreshold": 400,
                  "galleryThumbHeight": 320,
                  "galleryThumbLoadPadding": 3,
                  "galleryThumbWidth": 200,
                  "pageModeEnabled": true
                },
                "content": {
                  "select": "Download",
                  "selectAll": "Select All",
                  "title": "Select Pages for Download"
                }
              },
              "pagingHeaderPanel": {
                "options": {
                  "autoCompleteBoxEnabled": true,
                  "autocompleteAllowWords": false,
                  "galleryButtonEnabled": true,
                  "imageSelectionBoxEnabled": false,
                  "pageModeEnabled": false,
                  "pagingToggleEnabled": true
                },
                "content": {
                  "close": "Close",
                  "emptyValue": "Please enter a value",
                  "first": "First",
                  "firstImage": "First Image",
                  "firstPage": "First Page",
                  "folio": "Folio",
                  "gallery": "Gallery",
                  "go": "Go",
                  "help": "Help",
                  "image": "Image",
                  "last": "Last",
                  "lastImage": "Last Image",
                  "lastPage": "Last Page",
                  "next": "Next",
                  "nextImage": "Next Image",
                  "nextPage": "Next Page",
                  "of": "of {0}",
                  "oneUp": "Single page view",
                  "page": "Page",
                  "pageSearchLabel": "Search by Page Number",
                  "previous": "Previous",
                  "previousImage": "Previous Image",
                  "previousPage": "Previous Page",
                  "settings": "Settings",
                  "twoUp": "Two page view"
                }
              },
              "openSeadragonCenterPanel": {
                "options": {
                  "animationTime": 0.15,
                  "autoHideControls": true,
                  "requiredStatementEnabled": true,
                  "blendTime": 0,
                  "constrainDuringPan": false,
                  "controlsFadeAfterInactive": 1500,
                  "controlsFadeDelay": 250,
                  "controlsFadeLength": 250,
                  "defaultZoomLevel": 0,
                  "immediateRender": false,
                  "maxZoomPixelRatio": 1.25,
                  "navigatorPosition": "BOTTOM_RIGHT",
                  "pageGap": 50,
                  "showHomeControl": false,
                  "trimAttributionCount": 150,
                  "visibilityRatio": 0.5
                },
                "content": {
                  "attribution": "Attribution",
                  "goHome": "Go Home",
                  "imageUnavailable": "Image Unavailable",
                  "next": "Next",
                  "previous": "Previous",
                  "rotateRight": "Rotate Right",
                  "zoomIn": "Zoom In",
                  "zoomOut": "Zoom Out"
                }
              },
              "searchFooterPanel": {
                "options": {
                  "elideDetailsTermsCount": 20,
                  "elideResultsTermsCount": 10,
                  "forceImageMode": false,
                  "pageModeEnabled": true,
                  "positionMarkerEnabled": true
                },
                "content": {
                  "clearSearch": "Clear",
                  "defaultLabel": "-",
                  "displaying": "{0} {1} of {2}",
                  "enterKeyword": "Enter Keyword",
                  "image": "image",
                  "imageCaps": "Image",
                  "instanceFound": "1 instance of '{0}' found",
                  "instancesFound": "{0} instances of '{1}' found",
                  "nextResult": "Next Result",
                  "page": "page",
                  "pageCaps": "Page",
                  "previousResult": "Previous Result",
                  "print": "Print",
                  "resultFoundFor": "result found for",
                  "resultsFoundFor": "results found for",
                  "searchWithin": "Search within this item:"
                }
              },
              "settingsDialogue": {
                "content": {
                  "locale": "Locale",
                  "navigatorEnabled": "Navigator Enabled",
                  "clickToZoomEnabled": "Mouse Click To Zoom",
                  "pagingEnabled": "Two Page View",
                  "reducedMotion": "Reduce motion (disables animations)",
                  "preserveViewport": "Preserve Zoom",
                  "title": "Settings",
                  "website": "<a href='https://github.com/universalviewer/universalviewer#contributors'>more info</a>"
                }
              },
              "shareDialogue": {
                "options": {
                  "embedTemplate": "<iframe src=\"{0}\" width=\"{1}\" height=\"{2}\" allowfullscreen frameborder=\"0\"></iframe>",
                  "instructionsEnabled": false,
                  "shareFrameEnabled": true,
                  "shareManifestsEnabled": true
                },
                "content": {
                  "customSize": "custom",
                  "embed": "Embed",
                  "embedInstructions": "To embed this item in your own website, copy and paste the code below.",
                  "height": "Height",
                  "iiif": "IIIF Manifest",
                  "share": "Share",
                  "shareInstructions": "To share this item, copy the URL below.",
                  "size": "Size:",
                  "width": "Width"
                }
              },
              "authDialogue": {
                "content": {
                  "cancel": "Cancel",
                  "confirm": "Confirm"
                }
              },
              "clickThroughDialogue": {
                "content": {
                  "viewTerms": "Read Full Terms and Conditions"
                }
              },
              "loginDialogue": {
                "content": {
                  "login": "Login",
                  "logout": "Logout",
                  "cancel": "Cancel"
                }
              },
              "mobileFooterPanel": {
                "content": {
                  "rotateRight": "Rotate Right",
                  "moreInfo": "More Information",
                  "zoomIn": "Zoom In",
                  "zoomOut": "Zoom Out"
                }
              },
              "restrictedDialogue": {
                "content": {
                  "cancel": "Cancel"
                }
              }
            },
            "localisation": {
              "label": "English (GB)",
              "locales": [
                {
                  "name": "cy-GB",
                  "label": "Cymraeg"
                },
                {
                  "name": "en-GB",
                  "label": "English (GB)"
                },
                {
                  "name": "fr-FR",
                  "label": "Français (FR)"
                },
                {
                  "name": "pl-PL",
                  "label": "Polski"
                },
                {
                  "name": "sv-SE",
                  "label": "Svenska"
                }
              ]
            },
            "content": {
              "authCORSError": "Your browser does not support CORS, please upgrade to view this content.",
              "authorisationFailedMessage": "Your log-in attempt did not appear to be successful. Please try again.",
              "canvasIndexOutOfRange": "Canvas index out of range.",
              "fallbackDegradedLabel": "Login",
              "fallbackDegradedMessage": "Please log in to view this content at full resolution.",
              "forbiddenResourceMessage": "Your current access rights are insufficient to view this image",
              "mediaViewer": "Media Viewer",
              "skipToDownload": "Skip to downloads and alternative formats",
              "termsOfUse": "Terms of Use"
            }
          }
        );
      });
      </script>
    </div>
</div>
<? else: ?>
  <!--div style="width:1000px; height: 500px">
    <h1>Awesome IIIF</h1>
    <p>
    IIIF is a set of open standards for delivering high-quality, attributed digital objects online at scale. It’s also an international community developing and implementing the IIIF APIs. IIIF is backed by a consortium of leading cultural institutions.
    </p>
  </div-->
  
<?php endif; ?>