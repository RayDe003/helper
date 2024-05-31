import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const setTypeNotificationRequest = (id, not_type) =>
  axios.post(
    apiLink(`tasks/${id}/notification`),
    {
      not_type_id: not_type
    },
    {
      headers: apiHeaders
    }
  );

export const changeTypeNotificationRequest = (id, not_type) =>
  axios.post(
    apiLink(`tasks/${id}/notification_change`),
    {
      not_type_id: not_type
    },
    {
      headers: apiHeaders
    }
  );
