const sweetAlertConfigs = {
global: {
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            toast: true,
            background: 'rgba(0,0,0,0)',
            padding: '0.5rem',
        },
    success (text='') {
        return {
            ...this.global,
            icon: 'success',
            title: 'Success',
            text
        }
    },
    error (text='') {
        return {
            ...this.global,
            icon: 'error',
            title: 'Error',
            text
        }
    },

    warning (text='') {
        return {
            ...this.global,
            icon: 'warning',
            title: 'Warning',
            text,
        }
    },

    info (text='') {
        return {
            ...this.global,
            icon: 'info',
            title: 'Info',
            text,
        }
    },
};
