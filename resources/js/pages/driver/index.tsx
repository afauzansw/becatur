import { Column, DataTable } from "@/components/data-table";
import { AppLayout } from "@/layouts/app-layout";
import { Base } from "@/types/base";
import { Driver } from "@/types/driver";
import { useForm } from "@inertiajs/react";
import axios from "axios";
import { useState } from "react";

export default function Home() {

    const [filters, setFilters] = useState({});
    const [id, setId] = useState<any>();

    const columns: Column<Driver>[] = [
        {
            id: 'id',
            header: 'ID',
            cell: (item) => item.id,
            sortable: false,
            isRowHeader: true,
        },
        {
            id: 'user_name',
            header: 'Customer Name',
            cell: (item) => item.name,
            sortable: false
        },
        {
            id: 'email',
            header: 'Email',
            cell: (item) => item.email,
            sortable: false
        },
        {
            id: 'phone',
            header: 'Phone',
            cell: (item) => item.phone,
            sortable: true
        },
    ];

    const fetchData = async (params: Record<string, any>) => {
        const response = await axios.get<Base<Driver[]>>(
            route('web.backoffice.driver.fetch', params)
        );
        return response.data;
    };

    return (
        <>
            <div className="flex justify-between" >
                <div>
                    <h1 className="text-xl font-semibold" >Driver</h1>
                    <p className="text-sm text-gray-600" >Operational</p>
                </div>
            </div>
            <div className="" >
                <DataTable
                    columns={columns}
                    fetchData={fetchData}
                    filters={filters}
                    onSort={(field, direction) => { }}
                />
            </div>
        </>
    )
}

Home.layout = (page: React.ReactNode) => <AppLayout children={page} />;
