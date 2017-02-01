/**
 * User: MyCroft
 * Date: 2013.08.23.
 * Time: 14:12
 * Project: d2cadmin3.3
 * Company: d2c
 */
$(document).ready(function () {

    var metadata = new CreateForm();
    metadata.formSubmitAfterSubmit = function(data) {
        if (USEIFRAME) {
            parent.location.reload();
            parent.$.fancybox.close();
        } else {
            location.href = ROOT + jsRouter.get('metadataDetails',{slug: data.id});
        }
    }
    metadata.init('metadata','metadata');

});