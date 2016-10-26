<div class="nm404-bs" style="margin-top: 20px; width: 99%;">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php _e('nm404 Errors (Last 30 entries)', NM404_TEXT_DOMAIN) ?></h4>
                    </div>
                    <div class="panel-body" style="min-height: 200px; padding: 0;">
                        <table class="table table-striped" style="margin: 0;">
                            <thead>
                                <tr>
                                    <th width="5%"><?php _e('#', NM404_TEXT_DOMAIN); ?></th>
                                    <th width="15%"><?php _e('Time', NM404_TEXT_DOMAIN); ?></th>
                                    <th><?php _e('Message', NM404_TEXT_DOMAIN); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; foreach($a_logs as $log_line) { $log=json_decode($log_line, true); if(!$log) continue; ?>
                                    <?php $i++; ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo date('d.m.Y H:i:s', $log['time']); ?>
                                        </td>
                                        <td>
                                            <?php echo $log['message']; ?>
                                        </td>
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