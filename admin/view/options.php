<div class="wrap propertyengine-options" id="propertyengine">
  <h2><?php _e('PropertyEngine Widgets Shortcodes', 'propertyengine') ?></h2>

  <p><?php _e('Welcome to the <em>PropertyEngine Widgets Shortcodes</em> configuration page!', 'propertyengine') ?>

  <p><?php _e('Enjoy the using this plugin', 'propertyengine') ?></p>

  <form action="options.php" method="post">
    <?php if ($wp_version < '2.7' && !isset($wpmu_version)): ?>
      <?php wp_nonce_field('update-options') ?>
      <input type="hidden" name="action" value="update" />
    <?php else: ?>
      <?php settings_fields('propertyengine');  ?>
    <?php endif ?>

    <div id="propertyengine-options-wrapper">
      <div id="propertyengine-main" class="postbox">
          <div class="inside">
              <h3><?php _e('Main Options', 'propertyengine') ?></h3>
              <table class="form-table">
                <tbody>
                  <tr>
                    <th scope="row">
                      <label for="propertyengine_tracking_id">
                        <?php _e('PropertyEngine Activation Key:', 'propertyengine') ?>
                      </label>
                    </th>
                    <td>
                      <input type="text"
                        id="propertyengine_tracking_id"
                        name="propertyengine_tracking_id"
                        value="<?php echo get_option('propertyengine_tracking_id') ?>" />
                      <span class="help">
                        <?php printf(
                                __('Your PropertyEngine Activation Key.', 'propertyengine')
                              ) ?>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
      </div>

      <div id="propertyengine-documentation" class="propertyengine-documentation postbox">
        <?php PropertyEngineWidgetsShortcodesAdmin::displayDocumentation() ?>
      </div>

    <p class="submit">
        <?php submit_button(); ?>
    </p>

  </form>
</div>