<div class="nm404-bs" style="margin-top: 20px; width: 99%;">
    <div class="col-md-12">
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="stars" class="btn btn-info" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                    <div class="hidden-xs"><?php _e('General', NM404_TEXT_DOMAIN); ?></div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    <div class="hidden-xs"><?php _e('Settings', NM404_TEXT_DOMAIN); ?></div>
                </button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                    <div class="hidden-xs"><?php _e('Help', NM404_TEXT_DOMAIN); ?></div>
                </button>
            </div>
        </div>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in active row" id="tab1">

                    <div class="col-md-6">
                        <form method="post" action="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?php _e('nm404 Status', NM404_TEXT_DOMAIN) ?></h4>
                                </div>
                                <div class="panel-body" style="min-height: 200px; font-size: 17px; padding: 0;">

                                    <table class="table table-striped" style="margin: 0;">
                                        <tbody>
                                        <tr>
                                            <td><?php _e('License', NM404_TEXT_DOMAIN); ?></td>
                                            <td>
                                                Free
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Author', NM404_TEXT_DOMAIN); ?></td>
                                            <td>
                                                <a target="_blank" href="https://www.affiliate-solutions.xyz/">Affiliate solutions SLU</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Plugin URL', NM404_TEXT_DOMAIN); ?></td>
                                            <td>
                                                <a href="https://wordpress.org/plugins/nm404/" target="_blank">https://wordpress.org/plugins/nm404/</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php _e('Plugin Version', NM404_TEXT_DOMAIN); ?></td>
                                            <td>
                                                <?php
                                                $data = get_plugin_data(NM404_PLUG_FILE);
                                                echo $data['Version'];
                                                ?>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                                <div class="panel-footer">
                                    <div class="button-float-wrapper" style="min-height: 40px;">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade in row" id="tab2">
                    <div class="col-md-6">
                        <form method="post" action="">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?php _e('nm404 Settings', NM404_TEXT_DOMAIN) ?></h4>
                                </div>
                                <div class="panel-body" style="min-height: 200px;">
                                    <?php if ($error) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only"><?php _e('Error', NM404_TEXT_DOMAIN); ?>:</span>
                                            <?php echo $error; ?>
                                        </div>
                                    <?php } elseif(!empty($_POST["sitemap_url"])) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <span class="sr-only"><?php _e('Success', NM404_TEXT_DOMAIN); ?>:</span>
                                            <?php _e('Settings saved', NM404_TEXT_DOMAIN); ?>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group">
                                        <label for="sitemap_url"><?php _e('Sitemap URL', NM404_TEXT_DOMAIN); ?></label>
                                        <input name="sitemap_url" class="form-control" type="text" placeholder="/sitemap.xml" id="sitemap_url" value="<?php echo $settings["sitemap_url"]; ?>">
                                        <p class="help-block">
                                            <?php
                                            $d = parse_url(get_site_url());
                                            $example = 'http://'.$_SERVER['SERVER_NAME'].'/sitemap.xml';
                                            ?>
                                            <?php printf(__('Relative (<small>%s</small>) or absolute urls (<small>%s</small>) are possible.', NM404_TEXT_DOMAIN), '/sitemap.xml', $example) ?><br/>
                                            <?php _e('The default sitemap url is <small>/sitemap.xml</small> .', NM404_TEXT_DOMAIN) ?><br/>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="limit_parsed_entries"><?php _e('Sitemap entries limit', NM404_TEXT_DOMAIN); ?></label>
                                        <input name="limit_parsed_entries" class="form-control" id="limit_parsed_entries" value="<?php echo (int)$settings["limit_parsed_entries"]; ?>" />
                                        <p class="help-block">
                                            <?php _e('For large blogs parsing dynamically generated XML-Sitemaps can take a lot of time.', NM404_TEXT_DOMAIN); ?><br />
                                            <?php _e('Limiting the entries parsed, increases speed but lowers quality of result.', NM404_TEXT_DOMAIN); ?><br />
                                            <?php _e('If your sitemap is split into more then one file, the limit is used for each single file.', NM404_TEXT_DOMAIN); ?><br />
                                            <?php _e('The default limit for entries is 1000.', NM404_TEXT_DOMAIN); ?><br />
                                            <?php _e('If you want to parse unlimited entries, set the limit to <b>-1</b>.', NM404_TEXT_DOMAIN); ?>
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label for="timeout"><?php _e('Sitemap retrieving timeout in seconds', NM404_TEXT_DOMAIN); ?></label>
                                        <input name="timeout" class="form-control" id="timeout" value="<?php echo (int)$settings["timeout"]; ?>" />
                                        <p class="help-block">
                                            <?php _e('If the nm404 url lookup runs into a timeout, the user will be shown the default 404 error page of your theme.', NM404_TEXT_DOMAIN); ?><br />
                                            <?php _e('The default timeout for retrieving the sitemap.xml is 3 seconds.', NM404_TEXT_DOMAIN); ?><br />
                                        </p>
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <div style="min-height: 40px;">
                                        <button name="save" value="save" class="btn btn-info btn-sm pull-right">
                                            <span class="glyphicon btn-glyphicon glyphicon glyphicon-ok img-circle text-info"></span>
                                            <?php _e('Save', NM404_TEXT_DOMAIN) ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade in row" id="tab4" style="text-align: center; max-width: 1900px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="text-align: left;">
                                    <?php _e('German Video Tutorials', NM404_TEXT_DOMAIN) ?>
                                </div>
                                <div class="panel-body" style="font-size: 17px; padding: 0;">
                                    <a href="https://www.youtube.com/watch?v=Oq7ORx6wnLY" target="_blank">
                                        <img src="//d.mc-cdn.net/s/nm404/video_tutorials_nm404_backend.jpg" style="width: 100%; max-width: 400px;" />
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" style="text-align: left;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php _e('Support', NM404_TEXT_DOMAIN) ?>
                                </div>
                                <div class="panel-body" style="font-size: 17px; padding: 0;">

                                    <table class="table table-striped" style="margin: 0;">
                                        <tbody>
                                        <tr>
                                            <td><?php _e('Support Forum:', NM404_TEXT_DOMAIN); ?></td>
                                            <td>
                                                <a href="https://forum.affiliate-solutions.xyz/free-affiliate-tools-f35/" target="_blank">https://forum.affiliate-solutions.xyz/</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><?php _e('Facebook Group:', NM404_TEXT_DOMAIN); ?></td>
                                            <td>
                                                <a href="https://www.facebook.com/groups/affiliatesolutions/" target="_blank">https://www.facebook.com/groups/affiliatesolutions/</a>
                                            </td>
                                        </tr>

                                        <tr></tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>


                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php _e('Social Networks', NM404_TEXT_DOMAIN) ?>
                                </div>
                                <div class="panel-body" style="font-size: 17px; padding: 66px;">

                                    <div class="onl_login">
                                        <div class="row onl_socialButtons" style="padding: 20px;">
                                            <div class="col-xs-3 col-sm-3">
                                                <a target="_blank" href="https://www.facebook.com/AffiliateSolutionsSL/" class="btn btn-lg btn-block onl_btn-facebook" data-toggle="tooltip" data-placement="top" title="Facebook">
                                                    <i class="fa fa-facebook fa-3x"></i>
                                                    <span class="hidden-xs"></span>
                                                </a>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <a target="_blank" href="https://plus.google.com/+Affiliate-solutionsBiz" class="btn btn-lg btn-block onl_btn-google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus">
                                                    <i class="fa fa-google-plus fa-3x"></i>
                                                    <span class="hidden-xs"></span>
                                                </a>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <a target="_blank" href="https://twitter.com/affiliso" class="btn btn-lg btn-block onl_btn-twitter" data-toggle="tooltip" data-placement="top" title="Twitter">
                                                    <i class="fa fa-twitter fa-3x"></i>
                                                    <span class="hidden-xs"></span>
                                                </a>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <a target="_blank" href="https://www.youtube.com/channel/UCsEll2dxPgfekhxX-y8WMqA" class="btn btn-lg btn-block onl_btn-google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus">
                                                    <i class="fa fa-youtube fa-3x"></i>
                                                    <span class="hidden-xs"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <script>
                                $(function () {
                                    $('[data-toggle="tooltip"]').tooltip()
                                })
                            </script>



                            <style type="text/css">
                                        @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
                                        @import url(//fonts.googleapis.com/css?family=Titillium+Web&subset=latin,latin-ext);
                                        @media (min-width: 768px) {
                                            .onl_row-sm-offset-3 div:first-child[class*="col-"] {
                                                margin-left: 25%;
                                            }
                                        }


                                        .onl_login .onl_socialButtons a {
                                            color: white; // In yourUse @body-bg
                                        opacity:0.9;
                                        }
                                        .onl_login .onl_socialButtons a:hover {
                                            color: white;
                                            opacity:1;
                                        }
                                        .onl_login .onl_socialButtons .onl_btn-facebook {background: #3b5998;border-color:#172d5e}
                                        .onl_login .onl_socialButtons .onl_btn-twitter {background: #00aced;border-color:#043d52}
                                        .onl_login .onl_socialButtons .onl_btn-google-plus {background: #c32f10;border-color:#6b1301}
                                        .onl_login .onl_socialButtons .onl_btn-soundcloud {background: #ff8800;border-color:#c73e04}
                                        .onl_login .onl_socialButtons .onl_btn-github {background: #666666;border-color:#333333}
                                        .onl_login .onl_socialButtons .onl_btn-steam {background: #878787;border-color:#292929}
                                        .onl_login .onl_socialButtons .onl_btn-pinterest {background: #cc2127;border-color:#780004}
                                        .onl_login .onl_socialButtons .onl_btn-vimeo {background: #1ab7ea;border-color:#162221}
                                        .onl_login .onl_socialButtons .onl_btn-lastfm {background: #c3000d;border-color:#5e0208}
                                        .onl_login .onl_socialButtons .onl_btn-yahoo {background: #400191;border-color:#230052}
                                        .onl_login .onl_socialButtons .onl_btn-vk {background: #45668e;border-color:#1a3352}
                                        .onl_login .onl_socialButtons .onl_btn-spotify {background: #7ab800;border-color:#3a5700}
                                        .onl_login .onl_socialButtons .onl_btn-linkedin {background: #0976b4;border-color:#004269}
                                        .onl_login .onl_socialButtons .onl_btn-stumbleupon {background: #eb4924;border-color:#943019}
                                        .onl_login .onl_socialButtons .onl_btn-tumblr {background: #35465c;border-color:#142030}

                                        }
                                    </style>

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: left">
                            <?php _e('Additional Plugins of Affiliate solutions', NM404_TEXT_DOMAIN) ?>
                        </div>
                        <div class="panel-body" style="font-size: 17px; padding: 40px;">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="img-thumbnail">
                                        <div class="panel-body" style="padding: 0;">
                                            <a href="<?php _e('https://offer.affiliate-solutions.xyz/bounce-jammer-en/', NM404_TEXT_DOMAIN); ?>" target="_blank">
                                                <img class="img-rounded" src="<?php echo NM404_URL; ?>/static/img/bj.png" style="width: 250px; max-width: 100%;" />
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="img-thumbnail">
                                        <div class="panel-body" style="padding: 0;">
                                            <a href="<?php _e('https://offer.affiliate-solutions.xyz/digi2mailpoet-en/', NM404_TEXT_DOMAIN); ?>" target="_blank">
                                                <img class="img-rounded" src="<?php echo NM404_URL; ?>/static/img/d2m.jpg" style="width: 250px; max-width: 100%;" />
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="img-thumbnail">
                                        <div class="panel-body" style="padding: 0;">
                                            <a href="<?php _e('https://offer.affiliate-solutions.xyz/customer-retargeting-en/', NM404_TEXT_DOMAIN); ?>" target="_blank">
                                                <img class="img-rounded" src="<?php echo NM404_URL; ?>/static/img/cr.png" style="width: 250px; max-width: 100%;" />
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="img-thumbnail">
                                        <div class="panel-body" style="padding: 0;">
                                            <a href="<?php _e('https://offer.affiliate-solutions.xyz/moreads-se-premium-en/', NM404_TEXT_DOMAIN); ?>" target="_blank">
                                                <img class="img-rounded" src="<?php echo NM404_URL; ?>/static/img/ma.png" style="width: 250px; max-width: 100%;" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(".btn-pref .btn").click(function () {
                jQuery(".btn-pref .btn").removeClass("btn-info").addClass("btn-default");
                jQuery(this).removeClass("btn-default").addClass("btn-info");
            });
        });


        jQuery('button[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('NM404activeTab', jQuery(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('NM404activeTab');
        if (activeTab) {
            jQuery(".btn-pref .btn").removeClass("btn-info").addClass("btn-default");
            jQuery('button[href="' + activeTab + '"]').tab('show').removeClass("btn-default").addClass("btn-info");
        }


    </script>
</div>