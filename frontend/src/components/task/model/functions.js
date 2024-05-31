export const trimText = (text, maxLength = 0, end = '...') => {
  if (text.length === undefined || maxLength === 0) return text;
  if (text.length > maxLength) {
    return text.slice(0, maxLength) + end;
  } else {
    return text;
  }
};
