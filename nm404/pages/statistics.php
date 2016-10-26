<div class="nm404-bs" style="margin-top: 20px; width: 99%;">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php _e('nm404 Statistics (Last 1000 redirects)', NM404_TEXT_DOMAIN) ?></h4>
                    </div>
                    <div class="panel-body" style="min-height: 200px; font-size: 17px; padding: 0;">
                        <table class="table table-striped" style="margin: 0;">
                            <thead>
                                <tr>
                                    <th width="5%"><?php _e('#', NM404_TEXT_DOMAIN); ?></th>
                                    <th><?php _e('URL', NM404_TEXT_DOMAIN); ?></th>
                                    <th width="5%"><?php _e('Redirects', NM404_TEXT_DOMAIN); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($logs as $url => $count) { $i++; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <?php if ((strlen(htmlentities($url)) > 51)){
                                            echo "<td title = \"".htmlentities($url)."\"><a href=\"http://".$url."\" target=\"_blank\">".substr(htmlentities($url),0,51)." (...)"."</a></td>";
                                        } else {
                                            echo "<td title = \"".htmlentities($url)."\"><a href=\"http://".$url."\" target=\"_blank\">".htmlentities($url)."</a></td>";
                                        } ?>
                                        <td><?php echo $count; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">
                        <div class="button-float-wrapper" style="min-height: 40px;">
                            <button name="flush_logs" value="1" class="btn btn-danger btn-sm pull-right">
                                <span class="glyphicon btn-glyphicon glyphicon glyphicon-remove img-circle text-info"></span>
                                <?php _e('Clear logs', NM404_TEXT_DOMAIN) ?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>