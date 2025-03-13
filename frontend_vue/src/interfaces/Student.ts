export interface Student {
    id: number;
    foto: string | null;
    nombre: string;
    apellido: string;
    created_at: string; // Cambiado de Temporal.PlainDateTime a   stringa
    update_at: string; // Cambiado de Temporal.PlainDateTime a   stringa
}
