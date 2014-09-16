$(document).ready(function(){

    // onMediaQuery
    MQ.init();

});

/**
 * Useful when using text-align: justify for grids.
 * Aligns children to the center when there's only one column.
 *
 * Example markup:
 *
 * <div data-center-justify style="text-align:justify">
 *     <span>Blah</span>
 *     <span>Blah 2</span>
 * </div>
 */
function centerJustify() {
    $("[data-center-justify]").each(function(index, elem) {
        var $elem = $(elem);
        var width = 0;

        $elem.children().each(function(index, child) {
            var $child = $(child);
            width += $child.outerWidth(true);
        });

        if (width > $elem.width()) {
            $elem.css({"text-align": "center"});
        } else {
            $elem.css({"text-align": "justify"});
        }
    });
}
$(window).load(centerJustify);
$(window).resize(centerJustify);

/**
 * Swap two elements
 * E.g. swap two elements when the media query is medium or smaller:
 * Example markup:
 *
 * <div data-swap-medium-primary="introTiles"></div>
 * <div data-swap-medium-secondary="introTiles"></div>
 *
 * <script>
 * MQ.addQuery({
 *     context: ['small', 'medium'],
 *     match: function() {
 *         swapOn("medium");
 *     }
 * });
 *
 * MQ.addQuery({
 *     context: 'large-up',
 *     match: function() {
 *         swapBackFrom("medium");
 *     }
 * });
 * </script>
 *
 * @param size
 */
function swapOn(size) {
    var $items = $("[data-swap-" + size + "-primary]");
    $items.each(function(index, elem) {
        var $elem = $(elem);
        if (!$elem.data("alreadySwapped")) {

            var id = $elem.data("swap-" + size + "-primary");
            var $partner = $("[data-swap-" + size + "-secondary='" + id + "']").first();

            if ($partner.size) {
                // Swap!
                $elem.data("alreadySwapped", true);

                $elem.clone(true, true).insertBefore($partner);
                $partner.clone(true, true).insertBefore($elem);

                $elem.remove();
                $partner.remove();


            }
        }
    });
}

function swapBackFrom(size) {
    var $items = $("[data-swap-" + size + "-primary]");
    $items.each(function(index, elem) {
        var $elem = $(elem);
        if ($elem.data("alreadySwapped")) {

            var id = $elem.data("swap-" + size + "-primary");
            var $partner = $("[data-swap-" + size + "-secondary='" + id + "']").first();

            if ($partner.size) {
                // Swap!
                $elem.data("alreadySwapped", false);

                $elem.clone(true, true).insertBefore($partner);
                $partner.clone(true, true).insertBefore($elem);

                $elem.remove();
                $partner.remove();


            }
        }
    });
}

