export interface ConfirmButtonOptions {
    url: string;
    method: 'get' | 'post' | 'put' | 'delete';
    data: {
        [key: string]: string | number | undefined;
    };
    id: number;
    title: string;
    message: string;
}