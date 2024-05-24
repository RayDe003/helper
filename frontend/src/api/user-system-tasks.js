import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const getAllSystemTasksRequest = () =>
  axios.get(apiLink('system_tasks'), { headers: apiHeaders });
export const getDailySystemTasksRequest = () =>
  axios.get(apiLink('system_tasks/today'), { headers: apiHeaders });

export const getRandomTasksRequest = () =>
  axios.get(apiLink('system_tasks/random'), { headers: apiHeaders });

export const randomizeSystemTaskRequest = (id) =>
  axios.post(
    apiLink('system_tasks/rerandom'),
    { random_task_id: id },
    { headers: apiHeaders }
  );

export const acceptSystemTaskRequest = (id, accept) =>
  axios.patch(
    apiLink(`system_tasks/${id}/accept`),
    { accept: accept },
    { headers: apiHeaders }
  );

export const deleteSystemTaskRequest = (id) =>
  axios.delete(apiLink('system_tasks/delete'), { headers: apiHeaders });

export const completeSystemTaskRequest = (id) =>
  axios.patch(
    apiLink('system_tasks/complete'),
    { random_task_id: id },
    { headers: apiHeaders }
  );
