$(function () {
    // search subscriber start
    $('#searchsubscriber').validate({
            
        submitHandler: function(form,e) {
            searchData('subscriber', 'searchsubscriber', 'subscriberListTableDiv', 'subscriberListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // search subscriber end
});

function resetSubscriberSearch(){
    $('.process-loader-wrapper').show();
    $('#subscriber_email_search').val('');
    
    reloadList('subscriber', 'subscriberListTableDiv', 'subscriberListTable');
}
