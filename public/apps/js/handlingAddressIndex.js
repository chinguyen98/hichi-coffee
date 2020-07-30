function deleteAddress(id) {
    fetch(`/api/address/${id}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    }).then(() => {
        document.querySelector(`.customerAddress-${id}`).remove();
    })
}