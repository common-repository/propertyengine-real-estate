<h3><?php _e('PropertyEngine Widgets Shortcodes documentation', 'propertyengine') ?></h3>
<div class="inside">
    <h4><?php _e('PropertyEngine Carrousel', 'propertyengine') ?></h4>
    <ul>
        <li>
            <strong><?php _e('Shortcode:', 'propertyengine') ?></strong>
            <code>[propertyengine-livelist][/propertyengine-livelist]</code>
        </li>
        <li>
            <strong><?php _e('Example:', 'propertyengine') ?></strong>
            <code>[propertyengine-livelist view="both"]123456-9876-1234-4567-abcdefgh[/propertyengine-livelist]</code>
        </li>
        <li>
            <strong><?php _e('Options:', 'propertyengine') ?></strong>
            <ul>
                <li>
                    <code>view</code>:
                    {both, map, list}
                    <?php _e('select which view(s) you wish this plugin to display', 'propertyengine') ?>
                </li>
                <li>
                    <code>startview</code>:
                    {map, list}
                    <?php _e('select which view is displayed on the initial load', 'propertyengine') ?>
                </li>
                <li>
                    <code>showsearch</code>:
                    [yes, now]
                    <?php _e('toggle the users ability to search', 'propertyengine') ?>
                </li>
                <li>
                    <code>showstatus</code>:
                    [unreleased, available, under-offer,sold]
                    <?php _e('gives the ability to only display and filter by a selected criteria of statuses', 'propertyengine') ?>
                </li>
                <li>
                    <code>hidecolumns</code>:
                    [status, label, phase, block, floor, description, price]
                    <?php _e('Gives you the ability to control which columns are view-able in the list view', 'propertyengine') ?>
                </li>
            </ul>
        </li>
        <li>
            <strong><?php _e('Content:', 'propertyengine') ?></strong>
            <?php _e('Widget ID, contained in HTML parameter value like this:', 'propertyengine') ?>
            <code><span style="background: #ffc">123456-9876-1a2b-4567-abcdefgh</span></code>.
        </li>
    </ul>
</div>
