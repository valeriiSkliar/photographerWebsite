const sweetAlertConfigs = {
    global: {
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        toast: true,
        background: '#151515',
        padding: '0.5rem',
    },
    modalGlobal: {
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    },
    success(text = '') {
        return {
            ...this.global,
            icon: 'success',
            title: 'Success',
            text
        }
    },
    error(text = '') {
        return {
            ...this.global,
            icon: 'error',
            title: 'Error',
            text
        }
    },

    warning(text = '') {
        return {
            ...this.global,
            icon: 'warning',
            title: 'Warning',
            text,
        }
    },

    info(text = '') {
        return {
            ...this.global,
            icon: 'info',
            title: 'Info',
            text,
        }
    },
    modalConfirm(title= "Are you sure?", text="You won\\'t be able to revert this!", confirmButtonText = 'Yes, delete it!' ) {
        return {
            ...this.modalGlobal,
            title,
            text,
            confirmButtonText,
        }
    }
};
