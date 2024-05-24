import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const getAchievementsRequest = () =>
  axios.get(apiLink(`achievements`), {
    headers: apiHeaders
  });
