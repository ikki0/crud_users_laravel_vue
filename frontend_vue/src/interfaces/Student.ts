import { Temporal } from "temporal-polyfill";

export interface Student {
    id: number;
    foto: string | null;
    nombre: string;
    apellido: string;
    registro: string;
    created_at: string; // Cambiado de Temporal.PlainDateTime a string
}
