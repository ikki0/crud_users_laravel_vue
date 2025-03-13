import Swal from "sweetalert2";
import axios, { AxiosResponse } from "axios";
import { ConfirmButtonOptions } from "@/interfaces/ConfirmButtonOptions";
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

export function confirmButton(options: ConfirmButtonOptions) {
    // CUSTOMIZAR VENTANA DE CONFIRMACION
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-3',
            cancelButton: 'btn btn-danger'
        }, buttonsStyling: false
    });

    // MOSTRAR VENTANA DE CONFIRMACION
    swalWithBootstrapButtons.fire({
        title: options.title,
        text: options.message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Eliminar',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            genericRequest(options.url, options.method, options.data);
        } else {
            showAlert('Operación cancelada', 'info');
        }
    });
}

export async function genericRequest(url: string, method: string, data: {}): Promise<void> {

    try { // RESPUESTA STATUS 200
        const response: AxiosResponse = await axios({
            url,
            method,
            data
        });
        showAlert(response.data.message, 'success');
        window.setTimeout(() => {
            window.location.href = '/';
        }, 1500);

    } catch (error) { // RESPUESTA STATUS 4xx/5xx
        showAlert('error en solicitud: ' + error, 'error'); // ESTUDIANTE NO ELIMINADO
    }
};
