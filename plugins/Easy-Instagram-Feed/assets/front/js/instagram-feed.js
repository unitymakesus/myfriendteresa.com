var feed = new Instafeed({
    get: "user",
    userId: parseInt(eif_vars.user_id),
    accessToken: eif_vars.accessToken,
    clientId: eif_vars.client_id,
    useHttp: true,
    resolution : "standard_resolution",
    limit: eif_vars.number_photos,
    sortBy: "most-recent",
    template: '<div class="feed-thumbnail"><a href="{{link}}"><img src="{{image}}" /></a></div>'
});
feed.run();