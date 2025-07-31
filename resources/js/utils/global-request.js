// src/utils/httpClient.js
import axios from 'axios'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  withCredentials: true,
})

export async function httpRequest({
  method = 'get',
  url = '',
  data = null,
  params = {},
  token = null,
  headers = {}
}) {
  try {
    const response = await api.request({
      method,
      url,
      data,
      params,
      headers: {
        'Content-Type': 'application/json',
        Authorization: token ? `Bearer ${token}` : '',
        ...headers,
      }
    })
    return response.data
  } catch (error) {
    console.error('Error en HTTP:', error.response || error)
    throw error
  }
}
