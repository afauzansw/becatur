import { Column, DataTable } from "@/components/data-table";
import { Button, Menu, Modal } from "@/components/ui";
import { AppLayout } from "@/layouts/app-layout";
import { Reservation } from "@/types/reservation";
import { useForm } from "@inertiajs/react";
import { IconCircleCheck, IconEye } from "justd-icons";
import { useState } from "react";
import { toast } from "sonner";
import { Base } from "@/types/base";
import axios from "axios";
import { number_format } from "@/utils/format";
import { Header } from "@/components/header";

export default function ReservationIndex() {

    const [filters, setFilters] = useState({});
    const [id, setId] = useState<any>();
    const { put, data, setData } = useForm<any>();

    const onApprove = (e: { preventDefault: () => void }) => {
        e.preventDefault();

        put(route('web.backoffice.reservation.accept-payment', id), {
            onSuccess: () => {
                toast.success('Data deleted successfully');
            },
            onError: (error) => {
                toast('Whoopsss....', {
                    description: JSON.stringify(error)
                });
            }
        });
    };

    const columns: Column<Reservation>[] = [
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
            cell: (item) => item.user.name,
            sortable: false
        },
        {
            id: 'driver_name',
            header: 'Driver Name',
            cell: (item) => item.driver?.name,
            sortable: false
        },
        {
            id: 'status',
            header: 'Status',
            cell: (item) => item.status,
            sortable: true
        },
        {
            id: 'payment_status',
            header: 'Payment Status',
            cell: (item) => item.payment_status,
            sortable: true
        },
        {
            id: 'total_price',
            header: 'Total Price',
            cell: (item) => "Rp " + number_format(item.total_price),
            sortable: false
        },
        {
            id: 'action',
            header: 'Action',
            cell: (item) => (
                <Menu>
                    <Menu.Trigger>
                        <Button size="extra-small" appearance="outline">Action</Button>
                    </Menu.Trigger>
                    <Menu.Content>
                        <Menu.Item href={route('web.backoffice.reservation.show', item.id)}>
                            <IconEye />
                            Detail
                        </Menu.Item>
                        {item.status === "PAID_BY_CUSTOMER" && (
                            <Menu.Item onAction={() => setId(item.id)}>
                                <IconCircleCheck />
                                Approve Payment
                            </Menu.Item>
                        )}
                    </Menu.Content>
                </Menu>
            ),
            sortable: false
        },
    ];

    const fetchData = async (params: Record<string, any>) => {
        const response = await axios.get<Base<Reservation[]>>(
            route('web.backoffice.reservation.fetch', params)
        );
        return response.data;
    };

    return (
        <>
            <Modal.Content isOpen={id} onOpenChange={() => setId(null)} >
                <Modal.Header>
                    <Modal.Title>Confirmation</Modal.Title>
                    <Modal.Description>
                        You want to approve payment, note this action is irreversible.
                    </Modal.Description>
                </Modal.Header>
                <Modal.Footer>
                    {
                        id && <form onSubmit={onApprove} >
                            <Button intent="custom" type="submit">
                                <IconCircleCheck />
                                Approve Payment
                            </Button>
                        </form>
                    }
                </Modal.Footer>
            </Modal.Content>

            <Header title="Reservation" />

            <div className="rounded-xl border border-gray-200 shadow-md p-4" >
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

ReservationIndex.layout = (page: React.ReactNode) => <AppLayout children={page} />;
