export interface InterfaceRequest {
    url: string;
    method: 'get' | 'post' | 'put' | 'delete';
    data: {
        [key: string]: string | number | undefined;
    };
}