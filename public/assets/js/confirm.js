function confirmAction(message, action, id) {
    $('#confirmForm').attr('action', action);
    $('#requestId').val(id);
    $('#confirmMessage').text(message);
    $('#confirmModal').modal('toggle');
}