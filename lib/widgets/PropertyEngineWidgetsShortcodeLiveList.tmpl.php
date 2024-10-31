<?php
wp_enqueue_script("jquery");
wp_enqueue_style('propertyengine-main', WP_PLUGIN_URL.'/propertyengine-real-estate/web/css/livelist.css');
wp_enqueue_style('propertyengine-ie7-fix', WP_PLUGIN_URL.'/propertyengine-real-estate/web/css/font-awesome-ie7.css');
wp_enqueue_script('propertyengine-tmpl', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/jquery.tmpl.js');
wp_enqueue_script('propertyengine-gmap', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
wp_enqueue_script('propertyengine-underscore', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/underscore-min.js');
wp_enqueue_script('propertyengine-backbone', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/backbone-min.js');
wp_enqueue_script('propertyengine-bootstrap', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/bootstrap.min.js');
wp_enqueue_script('propertyengine-dataTables', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/jquery.dataTables.min.js');
wp_enqueue_style('propertyengine-slider', WP_PLUGIN_URL.'/propertyengine-real-estate/web/css/jquery.slider.min.css');
wp_enqueue_script('propertyengine-slider', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/jquery.slider.min.js');
wp_enqueue_script('propertyengine-infobox', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/gmap.infobox.min.js');
wp_enqueue_script('propertyengine-attributes', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/propertyengine-attributes.js');
wp_enqueue_script('propertyengine-main', WP_PLUGIN_URL.'/propertyengine-real-estate/web/javascript/propertyengine.js');

$showstatusArray = explode( ",", $attributes['showstatus'] );
$sharebuttonArray = !empty($attributes['sharebutton'])?explode( ",", $attributes['sharebutton']  ):null;
?>
<?php wp_head(); ?>
<div class="pe-plugins" style="width:100%; margin:50px auto;">
    <div id="live-list-1" class="pe-live-list" >
        <div class="pe-loading-overlay">
            <div class="pe-progress-wrapper">
                <div class="progress progress-striped active">
                  <div class="bar" style="width: 10%;"></div>
                </div>
            </div>
        </div>
        <div class="btn-toolbar">
            <div class="view-toggle btn-group pull-left">
                <?php if (is_null($attributes['view']) || $attributes['view'] == "list"){ ?>
                    <button class="btn <?php echo($attributes['startview']=='list' )?'active':'' ?>" data-toggle="list"><i class="icon-list"></i> List</button>
                <?php }

                if (is_null($attributes['view']) || $attributes['view'] == "map"){ ?>
                    <button class="btn <?php echo($attributes['startview']=='map' )?'active':'' ?>" data-toggle="map"><i class="icon-map-marker"></i> Map</button>
                <?php }  ?>
            </div>
        </div>
        <?php  if (!is_null($attributes['showsearch']) && $attributes['showsearch'] === "yes"){  ?>
        <ul class="pe-search-bar search clearfix">
            <li class="status-filter">
                <label>Status</label>
                <div class="btn-group" data-toggle="buttons-checkbox">
                    <?php if (in_array('unreleased',$showstatusArray)){ ?>
                        <button type="button" class="btn btn-small" value="unreleased">Unreleased</button>
                    <?php } if (in_array('available',$showstatusArray)) { ?>
                        <button type="button" class="btn btn-small" value="available"> Available</button>
                    <?php } if (in_array('under-offer',$showstatusArray)) { ?>
                        <button type="button" class="btn btn-small" value="under-offer"> Reserved</button>
                    <?php } if (in_array('sold',$showstatusArray)) { ?>
                        <button type="button" class="btn btn-small" value="sold">Sold</button>
                    <?php } ?>
                </div>
                <div class="status-input">
                    <ul class="unstyled legend-item">
                      <li><input type="checkbox" name="status" value="unreleased"/>Unreleased</li>
                      <li><input type="checkbox" name="status" value="available"/>Available</li>
                      <li><input type="checkbox" name="status" value="under-offer"/>Reserved</li>
                      <li><input type="checkbox" name="status" value="sold"/>Sold</li>
                    </ul>
                </div>
            </li>
            <li class="price-search">
                <label>Price</label>
                <div class="slider-container">
                    <div class="inline labels">min</div>
                    <div class="inline">
                        <div class="slider-wrapper">
                           <input class="amount" style="display:none" type="slider" name="price" value="30000.5;60000" />
                        </div>
                    </div>
                    <div class="inline labels">max</div>
                </div>
            </li>
            <li class="floor-search">
                <label>Floor</label>
                <div>
                    <select class="floor-selector">
                        <option value="none">All Floors</option>
                    </select>
                </div>
            </li>
        </ul>
        <?php } ?>
        <?php if ($attributes['view'] == "list" || is_null($attributes['view'])){ ?>
        <div class="content-container">
            <div class="property-engine-table">
                <table cellpadding="0" cellspacing="0" border="0" class="livelist-table table table-striped">
                    <thead>
                        <tr>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
        <?php if ($attributes['view'] == "map" || is_null($attributes['view'])){ ?>
        <div class="property-engine-map-canvas" style="width:100%;height:500px;">

        </div>
        <?php } ?>
        <div class="legend clearfix">
            <div class="status-legend">
                <h5>Status</h5>
                <ul class="legend-item unstyled">
                    <?php if (in_array('unreleased',$showstatusArray)){ ?>
                        <li><i class="pe-status-unreleased icon-stop"></i> Unreleased</li>
                    <?php } if (in_array('available',$showstatusArray)) { ?>
                        <li><i class="pe-status-available icon-stop"></i> Available</li>
                    <?php } if (in_array('under-offer',$showstatusArray)) { ?>
                        <li><i class="pe-status-under-offer icon-stop"></i> Reserved</li>
                    <?php } if (in_array('sold',$showstatusArray)) { ?>
                        <li><i class="pe-status-sold icon-stop"></i> Sold</li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="pe-modal-plugin modal hide fade" style="display:none">
            <div class="modal-header">
                <button type="button" class="close pe-close-modal" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Contact an agent</h3>
            </div>
            <form action="#">
                <div class="modal-body">
                    <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Name</label>
                                <div class="controls controls-row form-inline">
                                    <input type="text" class="span4 pe-input-firstname" name="firstName" placeholder="First Name" autofocus="autofocus">
                                    <input type="text" class="span8 pe-input-lastname" name="lastName" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="pe-input-email">Email</label>
                                <div class="controls">
                                    <input type="email" class="span12" id="pe-input-email" name="email" placeHolder="Email"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="pe-input-phone">Phone</label>
                                <div class="controls">
                                    <input type="tel" class="span12" id="pe-input-phone" name="phone" placeHolder="Phone Number"/>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label" for="pe-input-msg">Message</label>
                                <div class="controls">
                                    <textarea id="pe-input-msg" rows="7" cols="10" name="msg"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn pe-close-modal" data-dismiss="modal">Close</a>
                    <button class="btn btn-success" onclick="return submitUnitEnquiry(this);" data-loading-text="Submitting..."><i class="icon-envelope"></i> Send Enquiry</button>
                </div>
            </form>
        </div>
    </div>

    <script id="unit-balloon-template" type="text/x-jquery-tmpl">
        <div class="pe-unit-container">
            <div class="pe-unit-info-point"></div>
            <div class="pe-unit-info-window">
                <div class="pe-unit-info-content">
                    <span class="shareBadge">
                        <span class="forwardBadgeIcon"></span>
                    </span>
                    <h2 class="pe-unit-info-name">
                        <img src="https://s3-eu-west-1.amazonaws.com/propertyengine.file.uploads/assets/plugin/status-{{= unit.saleStatus.value.toLowerCase()}}-sml.png"/>
                        Stand Number: <strong>{{= unit.label.value}}</strong>
                    </h2>
                {{if unit.description}}
                <span class="pe-unit-info-desc">{{= unit.description.value}}</span>
                {{/if}}
                    <table class="table table-condensed table-striped">
                        <tbody>
                        {{each(key, unitRow) unit}}
                        {{if unitRow.title != ""}}
                        <tr><td class="label">{{= unitRow.title}}</td><td><strong>{{= unitRow.value}}</strong></td></tr>
                        {{/if}}
                        {{/each}}
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <button class="enquire btn btn-small btn-success pe-contact-button" onclick="openEnquireModalOnClick('{{= instanceId}}','{{= unit.label.value}}','{{= unit.remoteKey.value}}');"><i class="icon-envelope"></i>&nbsp;Enquire</button>
                    </div>
                </div>

                <a href="#" onclick="return closeInfoBox();"><span class="pe-close-info-bubble">Close</span></a>
            </div>
        </div>
    </script>
</div>
<script type="text/javascript">
    jQuery(function(){
        var imagePath = "https://s3-eu-west-1.amazonaws.com/propertyengine.file.uploads/assets/plugin/";

        initLiveList('live-list-1',{
            showStatus : '<?php echo $attributes['showstatus'];?>',
            view : "<?php echo $attributes['view']?$attributes['view']:'all';?>",
            startView : "<?php echo (is_null($attributes['view']))?($attributes['startview']?$attributes['startview']:'list'):($attributes['view']?$attributes['view']:'list'); ?>",
            hideColumns : "<?php echo $attributes['hidecolumns'];?>",
            height : 500,
            remoteKey : "<?php echo $value;?>",
            authenticationCode : "<?php echo get_option('propertyengine_tracking_id');?>",
            imageRoot : imagePath,
            peLeadURL : "http://www.propertyengine.com",
            remoteDataURL : "https://s3-eu-west-1.amazonaws.com/propertyengine.file.uploads/data/",
            enquiryMsg : "I'm interested in Unit {UNIT}. Please send me more information",
            waitingListMsg : "I'm interested in Unit {UNIT}. Please send me more information"
        });
    });
</script>