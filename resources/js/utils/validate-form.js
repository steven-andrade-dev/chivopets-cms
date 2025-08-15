/** ---------- Helpers de reglas (componibles) ---------- **/

export const required = (msg = "Este campo es obligatorio") => (v) =>
    (v ?? "") !== "" && String(v).trim() !== "" || msg;
  
  export const string = (msg = "Debe ser texto") => (v) =>
    v == null || typeof v === "string" || msg;
  
  export const number = (msg = "Debe ser número") => (v) =>
    v == null || typeof v === "number" || (!Number.isNaN(Number(v))) || msg;
  
  export const boolean = (msg = "Debe ser verdadero/falso") => (v) =>
    v == null || typeof v === "boolean" || msg;
  
  export const minLen = (n, msg = `Mínimo ${n} caracteres`) => (v) =>
    v == null || String(v).trim().length >= n || msg;
  
  export const maxLen = (n, msg = `Máximo ${n} caracteres`) => (v) =>
    v == null || String(v).trim().length <= n || msg;
  
  export const pattern = (re, msg = "Formato inválido") => (v) =>
    v == null || re.test(String(v)) || msg;
  
  export const email = (msg = "Email inválido") =>
    pattern(/^[^\s@]+@[^\s@]+\.[^\s@]+$/, msg);
  
  export const inList = (values, msg = "Valor no permitido") => (v) =>
    v == null || values.includes(v) || msg;
  
  export const custom = (fn, msg = "Valor inválido") => (v, all) =>
    fn(v, all) || msg; // fn retorna true/false
  
  /** ---------- Transforms (normalización opcional) ---------- **/
  
  export const trim = () => (v) => (typeof v === "string" ? v.trim() : v);
  export const toLower = () => (v) => (typeof v === "string" ? v.toLowerCase() : v);
  export const toNumber = () => (v) => (v === "" || v == null ? v : Number(v));

  export function validate(data, schema) {
    const errors = {};
    const values = { ...data };
  
    // 1) Normalización por campo
    for (const key of Object.keys(schema)) {
      const def = schema[key] || {};
      const transforms = def.transforms || [];
      let val = values[key];
      for (const t of transforms) val = t(val);
      values[key] = val;
    }
  
    // 2) Reglas por campo (se detiene en el primer error de cada campo)
    for (const key of Object.keys(schema)) {
      const def = schema[key] || {};
      const rules = def.rules || [];
      const val = values[key];
  
      for (const rule of rules) {
        const result = typeof rule === "function" ? rule(val, values) : true;
        if (result !== true) {
          errors[key] = result; // mensaje de error
          break;
        }
      }
    }
  
    return { valid: Object.keys(errors).length === 0, values, errors };
  }
  