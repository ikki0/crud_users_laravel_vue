import Swal from "sweetalert2";
import axios, { AxiosResponse } from "axios";
// intereasante la libreria de toast que si no mal recuerdo muestra una notificacion , dura unos cuantos segundos en plan success o error o warning

const ERROR_SEVER: string = 'Error: en el Servidor'

export function showAlert(title: string, icon: any, focus?: string) {
    // SI NO SE PASO CORRECTAMENTE EL ICONO, SE PONE EL FOCO EN EL ELEMENTO CON EL ID DEL ICONO
    if (!focus) {
        document.getElementById(icon)?.focus();
    }
    // GENERAR VENTANA PERSONALIZADA
    Swal.fire({
        title: title,
        icon: icon,
        customClass: {
            confirmButton: 'btn btn btn-primary',
            popup: 'animated zoomIn'
        }
    });
}

export function confirmButton(urlSlash: string, method: string, id: number, title: string, message: string) {
    // SI NO SE PASO CORRECTAMENTE EL ICONO, SE PONE EL FOCO EN EL ELEMENTO CON EL ID DEL ICONO
    enum RequestActionType {
        Delete = 'delete',
        // Post = 'post',
        // Put = 'put',
    }

    // verificar parametro existe en enum
    // esto ya no es necesario ya quie si no existe se agrega el valor others
    if (!Object.values(RequestActionType).includes(method as RequestActionType)) {
        throw new Error(`El valor '${method}' no existe en el enum.`);
    }

    // OBTENER LA CLAVE DEL ENUM
    // const keysRequest = Object.keys(RequestActionType) as Array<keyof typeof RequestActionType>;

    // Buscar la clave cuyo valor coincida con el parametro method (ej: delete) 
    // SI NO ENCUENTRA COINCIDENCIA CON ENUM -> EL VALOR POR DEFECTO SERÁ Others
    // const keyRequest: keyof typeof RequestActionType = keysRequest.find((key) => RequestActionType[key] === method) ?? 'Others';

    // const action = RequestActionType[keyRequest];



    const url = urlSlash + id;

    // OBJETO CON CLAVE -> ENUM Y VALOR FUNCIONES -> PETICIONES A SERVIDOR
    // const REQUEST_ACTIONS: { [key in RequestActionType]: (url: string, method: string, data: {}) => void } = {
    //     [RequestActionType.Delete]: (url: string, method: string, data: { [key: string]: number }) => genericRequest(url, method, data)
    // };

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-3',
            cancelButton: 'btn btn-danger'
        }, buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: title,
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Eliminar',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            // sendDeleteRequest(url, { id: id });
            genericRequest(url, method, { id: id });
        } else {
            showAlert('Operación cancelada', 'info');
        }
    });
}

export async function genericRequest(url: string, method: string, data: { [key: string]: number }): Promise<void> {
    // axios.delete(url, parameters).then(function (response) {
    //     const status = response.status;
    //     // verificar error status
    //     if (status !== 200) {
    //         showAlert(response.data().message, 'error'); // ESTUDIANTE NO ELIMINADO
    //     } else {
    //         showAlert(response.data().message, 'success') // ESTUDIANTE ELIMINADO
    //         window.setTimeout(function () {
    //             window.location.href = '/'
    //         }), 1000;
    //     }
    // }).catch(function (error) {
    //     showAlert(ERROR_SEVER, 'error');
    // });
    // try {
    //     // const response = await axios({ url, method, data })
    //     const response = axios({ url, method, data }).then(function (response) {
    //         const status = response.status;
    //         // verificar error status
    //         if (status !== 200) {
    //             throw new Error('no status 200')
    //             showAlert(response.data().message, 'error'); // ESTUDIANTE NO ELIMINADO
    //         } else {
    //             throw new Error('status 200')
    //             showAlert(response.data().message, 'success') // ESTUDIANTE ELIMINADO
    //             window.setTimeout(function () {
    //                 window.location.href = '/'
    //             }), 1000;
    //         }
    //     });

    // } catch (error) {
    //     showAlert('error en la solicitud: ' + error, 'error'); // ESTUDIANTE NO ELIMINADO
    //     console.error('Error en la solicitud:', error);
    //     throw error;
    // }

    try { // TODO EL BLOQUE ES CORRECTO -> STATUS 200
        const response: AxiosResponse = await axios({
            url,
            method,
            data
        });


        showAlert(response.data.message, 'success');

        window.setTimeout(() => {
            window.location.href = '/';
        }, 1500);

    } catch (error) {
        // Manejar errores de red, respuestas 4xx/5xx, etc.
        // if (axios.isAxiosError(error)) {
        //     const message = error.response?.data?.message || 'Error en la solicitud';
        //     showAlert(message, 'error');
        // } else {
        //     showAlert('Error desconocido', 'error');
        // }

        // console.error('Error en la solicitud:', error);

        // throw new Error('no status 200')
        showAlert('error en solicitud: ' + error, 'error'); // ESTUDIANTE NO ELIMINADO
    }
};
