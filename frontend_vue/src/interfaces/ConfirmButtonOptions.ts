import { InterfaceRequest } from "./InterfaceRequest";

export interface ConfirmButtonOptions {
    // url: string;
    // method: 'get' | 'post' | 'put' | 'delete';
    // data: {
    //     [key: string]: string | number | undefined;
    // };
    request: InterfaceRequest;
    id: number;
    title: string;
    message: string;
}