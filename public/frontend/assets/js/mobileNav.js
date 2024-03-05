$(function () {
    // Click event for the mobile nav button
    $("#mobile-nav-button").on("click", function () {
        console.log("Mobile nav button clicked");
        $("#mobile-nav").addClass("show-mobile-nav");
        $("#mobile-nav-backdrop").addClass("d-block");
    });

    // Click event for the close button inside mobile nav
    $("#mobile-nav-close-button").on("click", function () {
        console.log("Close button clicked");
        $("#mobile-nav").removeClass("show-mobile-nav");
        $("#mobile-nav-backdrop").removeClass("d-block");
    });

    // Click event for the backdrop to close the mobile nav
    $("#mobile-nav-backdrop").on("click", function () {
        $("#mobile-nav").removeClass("show-mobile-nav");
        $("body").removeClass("mobile-nav-open");
        $("#mobile-nav-backdrop").removeClass("d-block");
    });

    // mobile search bar
    // Toggle mobile search on magnifying glass icon click
    $("#mobile-search-button").on("click", function () {
        $("#mobile-search").addClass("show-mobile-search");
    });

    $("#mobile-search-close-button").on("click", function () {
        $("#mobile-search").removeClass("show-mobile-search");
    });
});
