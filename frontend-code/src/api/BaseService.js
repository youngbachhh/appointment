import axiosClient from './axiosClient';
import handleApiError from './errorHandler';


export class BaseService {
  constructor(basePath) {
    this.basePath = basePath;
  }

  async getAll() {
    try {
      return await axiosClient.get(`${this.basePath}`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

  async getById(id) {
    try {
      return await axiosClient.get(`${this.basePath}/${id}`);
    } catch (error) {
      handleApiError(error);
      return {};
    }
  }

  async create(data) {
    try {
      return await axiosClient.post(this.basePath, data);
    } catch (error) {
      handleApiError(error);
      return {};
    }
  }

  async update(id, data) {
    try {
      return await axiosClient.put(`${this.basePath}/${id}`, data);
    } catch (error) {
      handleApiError(error);
      return {};
    }
  }

  async patch(id, data) {
    try {
      return await axiosClient.patch(`${this.basePath}/${id}`, data);
    } catch (error) {
      handleApiError(error);
      return {};
    }
  }

  async delete(id) {
    try {
      await axiosClient.delete(`${this.basePath}/${id}`);
    } catch (error) {
      handleApiError(error);
    }
  }
}
