// VALIDADORES GENERALES DE FORMULARIOS

// VALIDAR CAMPO VACIOS 
export function validateIsEmptyField(data: string): boolean {
    return data.trim() === '';
}