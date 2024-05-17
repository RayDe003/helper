export * from './current-user.js';

export const apiLink = (api) => `${import.meta.env.VITE_API_URL}` + `${api}`;
