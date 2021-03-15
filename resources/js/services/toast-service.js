export default class ToastService {
    
    constructor(toast) {
        this.toast;
    }

    success(message) {
        this.toast({
            message: message,
            type: 'is-success',
            dismissible: true,
            animate: { in: 'fadeIn', out: 'fadeOut' },
        });
    }

    error(message) {
        this.toast({
            message: message,
            type: 'is-danger',
            dismissible: true,
            animate: { in: 'fadeIn', out: 'fadeOut' },
        });
    }
}